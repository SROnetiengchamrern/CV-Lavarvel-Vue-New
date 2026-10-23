<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CourseCertificate extends Model
{
    protected $fillable = [
        'aws_course_id',
        'title',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'sort_order',
    ];

    protected $appends = [
        'url',
        'is_image',
        'is_pdf',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(AwsCourse::class, 'aws_course_id');
    }

    public function getUrlAttribute(): string
    {
        $path = str_replace('\\', '/', ltrim((string) $this->file_path, '/'));

        // Relative path so links work on the current host/port (artisan serve or vhost).
        return '/media/'.$path;
    }

    public function getIsImageAttribute(): bool
    {
        $mime = strtolower((string) $this->mime_type);
        $name = strtolower((string) $this->original_name);

        return str_starts_with($mime, 'image/')
            || str_ends_with($name, '.png')
            || str_ends_with($name, '.jpg')
            || str_ends_with($name, '.jpeg')
            || str_ends_with($name, '.webp');
    }

    public function getIsPdfAttribute(): bool
    {
        return $this->mime_type === 'application/pdf'
            || str_ends_with(strtolower((string) $this->original_name), '.pdf');
    }
}
