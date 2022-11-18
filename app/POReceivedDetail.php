<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POReceivedDetail extends Model
{
    protected $table = 'po_received_details';
    protected $fillable = [
        'po_received_po_id',
        'item_name',
        'unit',
        'qty',
        'price', 
        'brand' ,
        'mfg_country',
        'mfg_company',
        'mfg_date',
        'manual_orignal_filename',
        'manual_filename',
        'created_by',
        'updated_by'
    ];
}
