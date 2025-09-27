<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Custdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        // 1) Auth
        $username = (string) $request->session()->get('customer_name', '');
        if ($username === '') {
            return response()->json(['success' => false, 'error' => 'unauthorized'], 401);
        }

        // 2) Customer
        $cust = Custdetail::select('idcustomer','username')->where('username', $username)->first();
        if (!$cust) {
            return response()->json(['success' => false, 'error' => 'customer_not_found'], 404);
        }

        // 3) Input
        $iditems    = array_values((array) $request->input('iditems', []));
        $addressKey = (string) $request->input('address_key', 'main'); // เก็บสตริงล้วน
        $paymethod  = strtoupper((string) $request->input('paymethod', 'COD'));

        if (empty($iditems)) {
            return response()->json(['success' => false, 'error' => 'no_items'], 422);
        }
        if (!in_array($paymethod, ['COD','BANK','CARD'], true)) {
            return response()->json(['success' => false, 'error' => 'invalid_paymethod'], 422);
        }

        // 4) ตะกร้าตาม iditems
        $cartItems = Cart::where('idcustomer', $cust->idcustomer)
            ->whereIn('iditem', $iditems)
            ->get(['iditem','pic','name','webpriceTHB','quantity','basepriceTHB','discount']);

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'error' => 'cart_items_not_found'], 404);
        }

        // 5) address ที่บันทึก = สตริง (“main” หรือ “123”)
        $addressValue = trim($addressKey) === '' ? 'main' : (string) $addressKey;

        // 6) ทำออเดอร์ (ไม่ใช้ by-reference, ไม่ใช้ lockForUpdate)
        try {
            $idOrder = DB::transaction(function () use ($cust, $cartItems, $addressValue, $paymethod) {
                $newId = Order::generateOrderNo();

                foreach ($cartItems as $it) {
                    Order::create([
                        'id_order'    => $newId,
                        'idcustomer'  => (string) $cust->idcustomer,
                        'address'     => $addressValue,          // ← สตริงล้วน
                        'iditem'      => (string) $it->iditem,
                        'pic'         => (string) ($it->pic ?? ''),
                        'name'        => (string) ($it->name ?? ''),
                        'webpriceTHB' => (string) ($it->webpriceTHB ?? '0'),
                        'quantity'    => (string) ($it->quantity ?? '1'),
                        'pay_by'       => (string) $paymethod,
                        'status'      => 'pending',
                        'create_at'   => now('Asia/Bangkok')->format('Y-m-d H:i:s'),
                    ]);
                }

                // เคลียร์ของที่สั่งจากตะกร้า
                Cart::where('idcustomer', $cust->idcustomer)
                    ->whereIn('iditem', $cartItems->pluck('iditem')->all())
                    ->delete();

                return $newId;
            }, 3);
        } catch (\Throwable $e) {
            \Log::error('checkout failed', [
                'msg'   => $e->getMessage(),
                'code'  => method_exists($e, 'getCode') ? $e->getCode() : null,
                'class' => get_class($e),
            ]);

          return redirect('/')->with('success', 'สร้างออเดอร์เรียบร้อย เลขที่: ' . $idOrder);
        }

        // 7) โหลดตะกร้าใหม่
        $itemsAfter = Cart::where('idcustomer', $cust->idcustomer)
            ->get(['iditem','pic','name','webpriceTHB','quantity','basepriceTHB','discount']);
        $totalQty   = (string) Cart::where('idcustomer', $cust->idcustomer)->sum('quantity');
        $subtotal   = (string) (Cart::where('idcustomer', $cust->idcustomer)
            ->selectRaw('COALESCE(SUM(webpriceTHB * quantity), 0) AS subtotal')
            ->value('subtotal') ?? '0');

        // 8) ส่งกลับ
        return response()->json([
            'success' => true,
            'message' => 'order_created',
            'order'   => [
                'id_order' => $idOrder,
                'pay_by'    => $paymethod,
                'address'  => $addressValue,
            ],
            'cart' => [
                'items'     => $itemsAfter,
                'totalQty'  => $totalQty,
                'subtotal'  => $subtotal,
            ],
        ], 201);
    }
}
