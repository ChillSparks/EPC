<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DOItem extends Model
{
    protected $table = 'do_items';
    protected $fillable = [
        'po_id',
        'item_name',
        'unit',
        'qty',
        'price', 
        'currency',
        'brand' ,
        'mfg_country',
        'mfg_company',
        'mfg_date',
        'manual_orignal_filename',
        'manual_filename'
    ];
    public function pocontracts()
    {
        return $this->belongsTo(POContract::class);
    }
}
