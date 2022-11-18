<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';
    protected $fillable = [
        'name',
        'des',
        'created_by',
        'updated_by'
    ];
}
