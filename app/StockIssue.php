<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockIssue extends Model
{
    protected $table = "stock_issue";
    protected $fillable = [
        'req_voucher_no', 
        'req_date',
        'issue_no',
        'issue_date',
        'to_dept',
        'division',
        'township',
        'reason', 
        'remark',
        'created_by',
        'updated_by'
    ];
}
