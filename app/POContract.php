<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POContract extends Model
{
    protected $table = 'po_contracts';
    protected $fillable = [
        'po_no',
        'po_date',
        'supplier_id',
        'do_no',
        'do_date',
        'remark',
        'created_by',
        'updated_by'
    ];
    public function doitems()
    {
        return $this->hasMany(DOItem::class);
    }
}
