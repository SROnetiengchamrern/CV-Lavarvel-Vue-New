<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvFile extends Model
{
    protected $table = 'cv_files';

    protected $fillable = [
        'title',
        'title_km',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'is_active',
    ];

    protected $appends = [
        'url',
        'download_url',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'file_size' => 'integer',
        ];
    }

    public function getUrlAttribute(): string
    {
        $path = str_replace('\\', '/', ltrim((string) $this->file_path, '/'));

        return '/media/'.$path;
    }

    public function getDownloadUrlAttribute(): string
    {
        return route('cv.download');
    }

    public static function active(): ?self
    {
        return static::query()
            ->where('is_active', true)
            ->latest('id')
            ->first();
    }
}
