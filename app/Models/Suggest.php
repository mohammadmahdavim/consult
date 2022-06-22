<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suggest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author','id');
    }
}
