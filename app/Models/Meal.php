<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// spatie sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// spatie sluggable

class Meal extends Model
{
    use HasFactory;
    use HasSlug;

    //Initialize every instance with 'status' => 'created'
    protected $attributes = [
        'status' => 'created',
    ];

    protected $fillable = [
        'title', 'description', 'status', 'slug', 'deleted_at'
    ]

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
