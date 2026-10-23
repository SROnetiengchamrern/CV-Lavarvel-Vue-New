<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvReference extends Model
{
    protected $fillable = [
        'name',
        'name_km',
        'title',
        'title_km',
        'organization',
        'organization_km',
        'phone',
        'sort_order',
    ];
}
