<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fluke extends Model
{
    protected $table = 'fluke';
    public $timestamps = false;

    protected $primaryKey = 'iditem';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'iditem','pic','name','model','basepriceTHB','discount','priceUSD','webpriceTHB','priceTHB','Stock','leadtime','category','source'
    ];
    protected $casts = [
        'priceUSD' => 'string',
        'priceTHB' => 'string',
        'quantity' => 'string',
        'discount' => 'string',
        'webpriceTHB' => 'string',
        'basepriceTHB' => 'string',
    ];
}
