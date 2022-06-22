<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function authorBlog()
    {
        return $this->belongsTo(User::class, 'aouthr','id');
    }

    public function writerBlog()
    {
        return $this->belongsTo(User::class, 'writer','id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function tag()
    {
        return $this->belongsToMany(tag::class, 'blog_tag');
    }

}
