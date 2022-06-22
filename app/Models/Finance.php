<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function authorRow()
    {
        return $this->belongsTo(User::class,'author')->withDefault();
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

}
