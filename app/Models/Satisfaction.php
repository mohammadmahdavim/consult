<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satisfaction extends Model
{
    use HasFactory ;

    protected $guarded=[];

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }
}
