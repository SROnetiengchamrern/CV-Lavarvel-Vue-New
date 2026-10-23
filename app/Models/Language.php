<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'name_km',
        'level',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'level' => 'integer',
        ];
    }
}
