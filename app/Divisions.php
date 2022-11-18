<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    protected $table = 'divisions';
    protected $fillable = [
        'name',
        'des',
        'created_by',
        'updated_by'
    ];
    public function townships()
    {
        return $this->hasMany(Townships::class);
    }
}
