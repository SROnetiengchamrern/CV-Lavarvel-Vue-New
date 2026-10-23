<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name',
        'full_name_km',
        'title',
        'title_km',
        'photo',
        'email',
        'phone_primary',
        'phone_secondary',
        'address',
        'address_km',
        'gender',
        'gender_km',
        'date_of_birth',
        'marital_status',
        'marital_status_km',
        'nationality',
        'nationality_km',
        'place_of_birth',
        'place_of_birth_km',
        'layout',
        'cover_letter_enabled',
        'cover_letter_salutation',
        'cover_letter_salutation_km',
        'cover_letter_body',
        'cover_letter_body_km',
        'cover_letter_closing',
        'cover_letter_closing_km',
        'cover_letter_signature',
        'cover_letter_signature_km',
    ];

    protected function casts(): array
    {
        return [
            'cover_letter_enabled' => 'boolean',
        ];
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->photo) {
            return null;
        }

        if (str_starts_with($this->photo, 'images/')) {
            return '/'.$this->photo;
        }

        if (str_starts_with($this->photo, 'profiles/')) {
            return '/media/'.$this->photo;
        }

        if (str_starts_with($this->photo, 'http') || str_starts_with($this->photo, '/')) {
            return $this->photo;
        }

        return '/'.$this->photo;
    }
}
