<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $table = 'tblorder';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_order','idcustomer','address','iditem','pic','name',
        'webpriceTHB','quantity','pay_by','status','create_at'
    ];

    // คอลัมน์เป็นสตริงทั้งหมดก็โอเค
    protected $casts = [
        'webpriceTHB' => 'string',
        'quantity'    => 'string',
        'create_at'   => 'string',
    ];

    public static function generateOrderNo(?\Carbon\Carbon $now = null): string
    {
        $now = $now ? $now->copy()->tz('Asia/Bangkok') : now('Asia/Bangkok');
        $prefix       = $now->format('ym');   // YYMM
        $datetimePart = $now->format('dHi');  // DDHHmm

        // กันเลขซ้ำแบบง่าย (ไม่ใช้ lock)
        $seq = 1;
        do {
            $idOrder = sprintf('%s-%s-%04d', $prefix, $datetimePart, $seq);
            $exists  = static::where('id_order', $idOrder)->exists();
            $seq++;
        } while ($exists && $seq <= 9999);

        return $idOrder;
    }
}
