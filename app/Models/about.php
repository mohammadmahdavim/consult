<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }
}
