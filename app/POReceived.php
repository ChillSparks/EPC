<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POReceived extends Model
{
    protected $table= 'po_received';
    protected $fillable = ['po_id','item_name','qty','chk_place','chk_date','vehicle_name','remark','chk_1','chk_2','chk_3','done'];
}
