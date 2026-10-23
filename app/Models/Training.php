<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'description',
        'description_km',
        'sort_order',
    ];
}
