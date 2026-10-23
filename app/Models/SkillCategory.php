<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SkillCategory extends Model
{
    protected $fillable = [
        'name',
        'name_km',
        'slug',
        'section',
        'section_km',
        'show_bars',
        'accent',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'show_bars' => 'boolean',
            'accent' => 'boolean',
        ];
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'category', 'slug')->orderBy('sort_order');
    }

    public static function makeSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'category';
        $slug = $base;
        $i = 2;

        while (
            static::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
