<?php

namespace App\Http\Controllers;
use App\Models\Fluke;
use App\Models\Custdetail;
use App\Models\Cart;
use App\Models\Order;  
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class DashboardController extends Controller
{
        public function index()
    {
        return view('product.index');
    }
 public function Home()
        {
    // helpers (จะเขียนไว้บนสุดของเมธอดก็ได้)
    $toFloat = function ($v) {
        if ($v === null) return null;
        // ลบทุกอย่างที่ไม่ใช่ตัวเลข จุด หรือเครื่องหมายลบ
        $clean = preg_replace('/[^\d\.\-]/', '', (string)$v);
        return is_numeric($clean) ? (float)$clean : null;
    };

    // --- flashDeals ---
    $flashDeals = Fluke::query()
        ->select(['iditem','name','pic','webpriceTHB','source'])
        ->whereNotNull('name')
        ->whereNotNull('pic')
        ->whereNotNull('webpriceTHB')
        ->orderBy('name')
        ->limit(500)
        ->get()
        ->map(fn($x) => [
            'iditem'   => $x->iditem,
            'name'     => $x->name,
            'pic'      => $x->pic,
            
            'webpriceTHB' => $toFloat($x->webpriceTHB), 
        ]);

    // --- products (autocomplete) ---
    $products = Fluke::query()
        ->select(['iditem','name','category','pic','webpriceTHB','model','source'])
        ->whereNotNull('name')
        ->orderBy('name')
        ->limit(3000)
        ->get()
        ->map(fn($x) => [
            'iditem'   => $x->iditem,
            'name'     => $x->name,
            'category' => $x->category,
            'image'    => $x->pic,
            'price'    => $toFloat($x->webpriceTHB),  
            'model'    => $x->model,
            
            'columnJ'  => null,
        ]);

            return view('test.FLUKE_Marketplace', [
                'flashDeals' => $flashDeals,
                'products'   => $products,
            ]);
        }
 public function showproduct()
    {
        $items = Fluke::select('iditem','pic','name','model','basepriceTHB','discount','priceUSD','webpriceTHB','priceTHB','Stock','leadtime','category','source')
            ->orderBy('name')
            ->paginate(30);

        return view('Product.showproduct', [
            'mode'       => 'all',
            'items'      => $items,
            'currentCat' => 'สินค้าทั้งหมด',
            
        ]);
    }
 public function byCategory(Request $request, string $slug)
    {
        $cfg     = config('product_type'); 
        $groups  = $cfg['groups']    ?? [];
        $labels  = $cfg['labels_th'] ?? [];

        if (!array_key_exists($slug, $groups)) {
            abort(404, "Unknown group: {$slug}");
        }

        $targets = $groups[$slug];

        // ✅ paginate 30 รายการต่อหน้า
        $items = Fluke::select('iditem','pic','name','model','basepriceTHB','discount','priceUSD','webpriceTHB','priceTHB','Stock','leadtime','category','source')
            ->where(function($q) use ($targets) {
                foreach ($targets as $t) {
                    $q->orWhere('category', $t)
                    ->orWhere('category', 'like', "%{$t}%");
                }
            })
            ->orderBy('name')
            ->paginate(30)                 // << เปลี่ยนจาก get() เป็น paginate(30)
            ->appends($request->query());  // พก query string เดิมเวลาคลิกหน้า

        // จัดกลุ่มจาก “รายการของหน้านี้เท่านั้น”
        $grouped = [];
        $others  = [];
        foreach ($items as $p) {
            $bucket = null;
            foreach ($targets as $t) {
                if (mb_stripos($p->category ?? '', $t, 0, 'UTF-8') !== false) {
                    $bucket = $t; break;
                }
            }
            if ($bucket) $grouped[$bucket][] = $p; else $others[] = $p;
        }

        $labelTh = $labels[$slug][0] ?? $slug;

        return view('Product.showproduct', [
            'mode'         => 'grouped',
            'groupKey'     => $slug,
            'groupLabelTh' => $labelTh,
            'targets'      => $targets,
            'grouped'      => $grouped,
            'others'       => $others,
            'items'        => $items, // ✅ ส่ง paginator ไปเพื่อแสดงลิงก์หน้า
        ]);
    }
 public function showItem(string $iditem)
    {
        $product = Fluke::select(
                'iditem','pic','name','model','basepriceTHB','discount','priceUSD','webpriceTHB','priceTHB','Stock','leadtime','category','source','document'
            
            )
            ->where('iditem', $iditem)
            ->firstOrFail();

        // คำนวน URL รูปให้พร้อมใช้ใน Blade
        $imageUrl = Str::startsWith($product->pic, ['http://','https://'])
            ? $product->pic
            : ($product->pic ? asset($product->pic) : asset('images/placeholder.png'));

        // แตก bullet ของรายละเอียด (คอลัมน์ J) ล่วงหน้า (ถ้าใช้)
        $bullets = [];
        if (!empty($product->columnJ)) {
            $txt = str_replace(["\r\n", "\r", "•", ";", ","], "\n", (string) $product->columnJ);
            $bullets = array_values(array_filter(array_map('trim', explode("\n", $txt))));
        }

        return view('test.product', [
            'product'  => $product,
            'imageUrl' => $imageUrl,
        ]);
    }
 public function searchByName(Request $request)
    {
        $q = trim($request->query('q', ''));
        if (mb_strlen($q) < 3) {
            return response()->json([]); // พิมพ์ < 3 ตัว ไม่ค้น
        }

        // แยกคำเพื่อให้ต้อง match ทุก token
        $tokens = preg_split('/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY);

        $query = Fluke::select('iditem','pic','name','model','basepriceTHB','discount','priceUSD','webpriceTHB','priceTHB','Stock','leadtime','category','source')
            ->when($tokens, function ($qq) use ($tokens) {
                foreach ($tokens as $t) {
                    $qq->where('name', 'like', '%'.$t.'%');
                }
            })
            ->orderBy('name')
            ->limit(10);

        $rows = $query->get();

        // map ให้ง่ายต่อการเรนเดอร์ dropdown + ลิงก์ไปหน้ารายละเอียดสินค้า
        $payload = $rows->map(function ($r) {
            return [
                'iditem' => $r->iditem,
                'name'   => (string) $r->name,
                'pic'    => (string) ($r->pic ?? ''),
                'price'  => is_null($r->webpriceTHB) ? null : (float) str_replace(',', '', $r->webpriceTHB),
                'url'    => route('product.detail', ['iditem' => $r->iditem]),
                'cat'    => (string) ($r->category ?? ''),
            ];
        });

        return response()->json($payload);
    }
 public function add(Request $request)
     {
        $sessionUsername =  $request->session()->get('customer_name'); 
        if (!$sessionUsername) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $customer = Custdetail::query()
            ->select(['idcustomer','username'])
            ->where('username', $sessionUsername)
            ->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        // 2) validate payload
        $v = $request->validate([
            'iditem'        => 'required|string|max:255',
            'pic'           => 'nullable|string|max:1000',
            'name'          => 'required|string|max:255',
            'basepriceTHB'  => 'nullable|string|max:255',
            'discount'      => 'nullable|string|max:255',
            'webpriceTHB'   => 'required|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'status' => ['required','string','max:50', Rule::in(['ตะกร้า'])],
        ]);

    try {
    $idcustomer = $customer->idcustomer;

    $cartItem = DB::transaction(function () use ($idcustomer, $v) {
        // 1) หาแถวเป้าหมาย โดยล็อกกันชนกัน
        $existing = Cart::where('idcustomer', $idcustomer)
            ->where('iditem', $v['iditem'])
            ->lockForUpdate()
            ->first();

        if ($existing) {
            // 2) อัปเดต "เฉพาะแถวนี้" ด้วยคู่เงื่อนไขเดิม
            Cart::where('idcustomer', $idcustomer)
                ->where('iditem', $v['iditem'])
                ->update([
                    'pic'          => $v['pic']          ?? $existing->pic,
                    'name'         => $v['name']         ?? $existing->name,
                    'basepriceTHB' => $v['basepriceTHB'] ?? $existing->basepriceTHB,
                    'discount'     => $v['discount']     ?? $existing->discount,
                    'webpriceTHB'  => $v['webpriceTHB']  ?? $existing->webpriceTHB,
                    'status'       => $v['status']       ?? ($existing->status ?: 'ตะกร้า'),
                    'quantity'     => DB::raw('GREATEST(1, quantity) + '.(int)$v['quantity']),
                ]);

            // อ่านกลับด้วยคู่เดิม (ไม่พึ่ง PK)
            return Cart::where('idcustomer', $idcustomer)
                ->where('iditem', $v['iditem'])
                ->first();
        }

        // 3) ถ้าไม่มี -> สร้างใหม่
        return Cart::create([
            'idcustomer'   => $idcustomer,
            'iditem'       => $v['iditem'],
            'pic'          => $v['pic']          ?? null,
            'name'         => $v['name'],
            'basepriceTHB' => $v['basepriceTHB'] ?? 0,
            'discount'     => $v['discount']     ?? 0,
            'webpriceTHB'  => $v['webpriceTHB'],
            'quantity'     => $v['quantity'],
            'status'       => $v['status']       ?? 'ตะกร้า',
        ]);
    });

    $count = Cart::where('idcustomer', $idcustomer)->sum('quantity');

    return response()->json([
        'success'     => true,
        'item'        => $cartItem,
        'cart_count'  => (int)$count,
        'idcustomer'  => $idcustomer,
    ], 201);

    } catch (\Throwable $e) {
        return response()->json(['error' => 'Server error: '.$e->getMessage()], 500);
    }
    }
 public function showcart(Request $request)
    {
        // 1) เอา user จาก session
        $sessionUsername = $request->session()->get('customer_name');
        if (!$sessionUsername) {
            return redirect()->route('login')->with('error', 'Please sign in.');
        }

        // 2) หา idcustomer จากตารางลูกค้า
        $customer = Custdetail::query()
            ->select(['idcustomer','username'])
            ->where('username', $sessionUsername)
            ->first();

        if (!$customer) {
            abort(404, 'Customer not found');
        }

        $idcustomer = $customer->idcustomer;

        // 3) ดึงรายการตะกร้าทั้งหมดของลูกค้าคนนี้
        $items = Cart::query()
            ->select('idcustomer','iditem','pic','name','basepriceTHB','discount','webpriceTHB','quantity','status')
            ->where('idcustomer', $idcustomer)
            ->get();

        // 4) คำนวณยอดรวม
        $totalQty = (int) $items->sum('quantity');
        $subtotal = (float) $items->sum(fn($r) => (float)$r->webpriceTHB * (int)$r->quantity);

        // 5) ส่งให้ view
        return view('test.cart', compact('items'));
    }
 public function cartJson(Request $request)
    {
        $sessionUsername = $request->session()->get('customer_name');
        if (!$sessionUsername) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $customer = Custdetail::select(['idcustomer','username'])
            ->where('username', $sessionUsername)
            ->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        $idcustomer = $customer->idcustomer;
        $items = Cart::select('idcustomer','iditem','pic','name',
                    'basepriceTHB','discount','webpriceTHB','quantity','status')
            ->where('idcustomer', $idcustomer)
            ->get();
        $totalQty = (int) $items->sum('quantity');
        $subtotal = (float) $items->sum(fn($r) => (float)$r->webpriceTHB * (int)$r->quantity);
        return response()->json([
            'idcustomer' => $idcustomer,
            'items'      => $items,
            'totalQty'   => $totalQty,
            'subtotal'   => $subtotal,
        ]);
        return view('test.cart', compact('itemscart'));
    }
 public function cartQty(Request $request)
    {
        $data = $request->validate([
            'iditem'   => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $sessionUsername = $request->session()->get('customer_name');
        if (!$sessionUsername) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $customer = Custdetail::select(['idcustomer'])
            ->where('username', $sessionUsername)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        Cart::where('idcustomer', $customer->idcustomer)
            ->where('iditem', $data['iditem'])
            ->update(['quantity' => $data['quantity']]);

        // ส่งสถานะล่าสุดกลับ
        return $this->cartJson($request);
    }

 public function cartRemove(Request $request)
    {
        $data = $request->validate([
            'iditem' => ['required', 'string'],
        ]);

        $sessionUsername = $request->session()->get('customer_name');
        if (!$sessionUsername) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $customer = Custdetail::select(['idcustomer'])
            ->where('username', $sessionUsername)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        Cart::where('idcustomer', $customer->idcustomer)
            ->where('iditem', $data['iditem'])
            ->delete();

        return $this->cartJson($request);
    }

 public function cartRemoveMany(Request $request) 
    {
        $data = $request->validate([
            'iditems' => ['required', 'array', 'min:1'],
            'iditems.*' => ['string'],
        ]);

        $sessionUsername = $request->session()->get('customer_name');
        if (!$sessionUsername) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $customer = Custdetail::select(['idcustomer'])
            ->where('username', $sessionUsername)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        Cart::where('idcustomer', $customer->idcustomer)
            ->whereIn('iditem', $data['iditems'])
            ->delete();

        return $this->cartJson($request);
    }


 private const THRESHOLD_FREE = 1500;
 private const SHIPPING_FEE   = 200;
 public function checkout(Request $request)
    {
        // 1) auth & customer
        $sessionUsername = $request->session()->get('customer_name');
        if (!$sessionUsername) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $customer = Custdetail::select(['idcustomer','username'])
            ->where('username', $sessionUsername)
            ->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        // 2) validate payload
        $v = $request->validate([
            'iditems'   => ['required','array','min:1'],
            'iditems.*' => ['string','max:255'],
        ]);

        $idcustomer = $customer->idcustomer;
        $iditems    = array_values(array_unique($v['iditems']));
        $now        = now('Asia/Bangkok');

        // 3) ทำงานแบบ atomic
        $payload = DB::transaction(function () use ($idcustomer, $iditems, $now) {

            // 3.1 ล็อกแถว cart ที่เลือก
            $rows = Cart::where('idcustomer', $idcustomer)
                ->whereIn('iditem', $iditems)
                ->lockForUpdate()
                ->get(['idcustomer','iditem','pic','name','webpriceTHB','quantity']);

            if ($rows->isEmpty()) {
                abort(422, 'Selected items not found in cart');
            }

            // 3.2 สร้างเลขคำสั่งซื้อ
            $idOrder = Order::generateOrderNo($now);

            // 3.3 เตรียมแถวที่จะ insert ลง table `order`
            $insertRows = [];
            foreach ($rows as $r) {
                $insertRows[] = [
                    'id_order'     => $idOrder,
                    'idcustomer'   => (string)$r->idcustomer,
                    'iditem'       => (string)$r->iditem,
                    'pic'          => $r->pic ?: null,
                    'name'         => (string)$r->name,
                    'webpriceTHB'  => round((float)$r->webpriceTHB, 2),
                    'quantity'     => max(1, (int)$r->quantity),
                    'status'       => 'อยู่ระหว่างการชำระเงิน',
                    'created_at'    => $now->format('Y-m-d H:i:s'),
                ];
            }

            DB::table('order')->insert($insertRows);

            Cart::where('idcustomer', $idcustomer)
                ->whereIn('iditem', $iditems)
                ->delete();
            $subtotal = $rows->reduce(fn($c,$r) => $c + ((float)$r->webpriceTHB * (int)$r->quantity), 0.0);
            $shipping = ($subtotal > 0 && $subtotal < self::THRESHOLD_FREE) ? self::SHIPPING_FEE : 0.0;
            $total    = $subtotal + $shipping;

            return [
                'id_order'   => $idOrder,
                'items_cnt'  => count($insertRows),
                'subtotal'   => round($subtotal, 2),
                'shipping'   => round($shipping, 2),
                'total'      => round($total, 2),
                'created_at' => $now->format('Y-m-d H:i:s'),
            ];
        });

        // 4) โหลด cart ที่เหลือส่งกลับไปอัปเดต UI
        $rest = Cart::where('idcustomer', $idcustomer)
            ->get(['idcustomer','iditem','pic','name','webpriceTHB','quantity','status']);

        $totalQty = (int)$rest->sum('quantity');
        $subtotal = (float)$rest->reduce(fn($c,$r)=> $c + ((float)$r->webpriceTHB * (int)$r->quantity), 0.0);

        return response()->json([
            'success'   => true,
            'order'     => $payload,
            'items'     => $rest,
            'totalQty'  => $totalQty,
            'subtotal'  => round($subtotal, 2),
        ], 201);
    }
}

