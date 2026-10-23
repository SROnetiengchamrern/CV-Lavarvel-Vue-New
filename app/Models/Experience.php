<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'years',
        'company',
        'company_km',
        'role',
        'role_km',
        'highlights',
        'highlights_km',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'highlights_km' => 'array',
        ];
    }
}
