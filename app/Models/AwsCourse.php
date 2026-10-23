<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AwsCourse extends Model
{
    protected $fillable = [
        'title',
        'title_km',
        'course_code',
        'role',
        'role_km',
        'is_completed',
        'badge_color',
        'sort_order',
    ];

    protected $appends = [
        'display_title',
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
        ];
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(CourseCertificate::class)->orderBy('sort_order');
    }

    public function getDisplayTitleAttribute(): string
    {
        if ($this->course_code) {
            return $this->title.' ['.$this->course_code.']';
        }

        return $this->title;
    }
}
