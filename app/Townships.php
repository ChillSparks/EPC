<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Townships extends Model
{
    protected $table = 'townships';
    protected $fillable = [
        'division_id',
        'name',
        'des',
        'created_by',
        'updated_by'
    ];
    public function divisions()
    {
        return $this->belongsTo(Divisions::class);
    }
}
