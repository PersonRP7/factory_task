<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// soft deletes
use Illuminate\Database\Eloquent\SoftDeletes;
// soft deletes

// spatie sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// spatie sluggable

// meal
use App\Models\Meal;
// meal

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    use HasSlug;

    protected $fillable = ['title'];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
