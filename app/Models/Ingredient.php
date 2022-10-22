<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Meal;

// spatie sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// spatie sluggable

class Ingredient extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'ingredient_meal');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_meal');
    }
}
