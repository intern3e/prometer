<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Custdetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'custdetail';
    public $timestamps = false;

    protected $primaryKey = 'idcustomer';
    public $incrementing = false;   // PK เป็นสตริง
    protected $keyType = 'string';

    protected $fillable = [
        'idcustomer', 'username','email', 'passuser', 'privilege','typecust','Legalentity_type','company_name','idtax','Branch_number',
        'main_address','main_subdistrict','main_district','main_province','main_postal','main_country','main_namecontact','email_contact','tel_contact','rank_contact'
    ];

    protected $hidden = ['passuser'];
    protected static function booted()
    {
        static::creating(function (self $model) {
            if (empty($model->idcustomer)) {
                $lastId = DB::table('custdetail')
                    ->where('idcustomer', 'like', 'cust-%')
                    ->lockForUpdate()
                    ->orderByRaw("CAST(SUBSTRING(idcustomer, 6) AS UNSIGNED) DESC")
                    ->value('idcustomer');

                $n = 1;
                if ($lastId && preg_match('/^cust-(\d+)$/', $lastId, $m)) {
                    $n = (int) $m[1] + 1;
                }
                $model->idcustomer = 'cust-' . str_pad((string) $n, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
