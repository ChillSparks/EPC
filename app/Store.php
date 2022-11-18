<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';
    protected $fillable = [
        'po_received_id',
        'po_received_po_id',
        'item_name',
        'warehouse',
        'store_code',
        'unit',
        'qty',
        'r_qty',
        'price', 
        'amt',
        'brand' ,
        'mfg_country',
        'mfg_company',
        'mfg_date',
        'manual_original_filename',
        'manual_filename',
        'created_by',
        'updated_by'
    ];
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
