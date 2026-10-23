<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'name_km',
        'level',
        'category',
        'show_bar',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'show_bar' => 'boolean',
            'level' => 'integer',
        ];
    }
}
