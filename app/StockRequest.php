<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    
    protected $table = 'stock_request';
    protected $fillable = [
        'voucher_no',
        'date',
        'confirm_date',
        'dept_biz_name',
        'reason',
        'division',
        'township',
        'remark',
        'created_by',
        'updated_by'
    ];
}
