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

// Category
use App\Models\Category;
//Category

// Tag
use App\Models\Tag;
// /Tag

class Meal extends Model
{
    use HasFactory;
    use SoftDeletes;

    use HasSlug;

    protected $fillable = ['category_id', 'tag_id', 'title', 'description', 'status'];

    protected $attributes = [
        'status' => 'created',
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

}
