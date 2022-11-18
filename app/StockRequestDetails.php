<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockRequestDetails extends Model
{
    protected $table = 'stock_request_details';
    protected $fillable = [
        'stock_request_id',
        'stock_code',
        'item_name',
        'unit',
        'qty',
    ];
}
