<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class pattern extends Model
{

    protected $guarded=[];
    public function items()
    {
        return $this->hasMany(patternItem::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function consult()
    {
        return $this->belongsTo(consult::class)->withDefault();
    }


}
