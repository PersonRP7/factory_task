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

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    use HasSlug;

    
}
