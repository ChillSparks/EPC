<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIssueDetail extends Model
{
    protected $table = 'stock_issue_details';
    protected $fillable = [
        'stock_issue_id',
        'stock_code',
        'item_name',
        'unit',
        'qty',
        'price',
        'amt',
    ];
}
