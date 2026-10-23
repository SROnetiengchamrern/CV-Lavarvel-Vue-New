<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'years',
        'institution',
        'institution_km',
        'description',
        'description_km',
        'sort_order',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(EducationDocument::class)->orderBy('sort_order');
    }
}
