<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// spatie sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// spatie sluggable

use App\Models\Tag;
use App\Models\Category;

class Meal extends Model
{
    use HasFactory;
    use HasSlug;

    //Initialize every instance with 'status' => 'created'
    protected $attributes = [
        'status' => 'created',
    ];

    // protected $fillable = [
    //     'title', 'description', 'status', 'slug', 'deleted_at'
    // ]
    protected $fillable = [
        'title', 'description', 'status', 'deleted_at'
    ];

    // soft delete 
    //Custom implementation because laravel soft delete trait disables mysql cascades
    //and doesn't implement soft delete for related models.
    public function softDelete()
    {
        $this->deleted_at = now();
        $this->status = 'deleted';
        $this->save();
    }
    // soft delete

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_meal');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
