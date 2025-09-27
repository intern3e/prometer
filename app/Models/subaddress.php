<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subaddress extends Model
{
    protected $table = 'subaddress';
    public $timestamps = false; 
    protected $primaryKey = 'idcustomer';
        protected $fillable = [
        'idsubaddress','idcustomer','sub_address','sub_subdistrict','sub_district','sub_province','sub_postal','sub_country','sub_namecontact','sub_email_contact','sub_tel_contact','sub_rank_contact'
    ];

}
