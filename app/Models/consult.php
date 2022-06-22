<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class consult extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault()->orderBy('family');
    }

    public function consult()
    {
        return $this->hasMany(Student::class);
    }


    public function field()
    {
        return $this->belongsTo(field::class)->withDefault();
    }

    public function university()
    {
        return $this->belongsTo(university::class)->withDefault();
    }

    public function state()
    {
        return $this->belongsTo(state::class)->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(state::class)->withDefault();
    }

    public function year()
    {
        return $this->belongsTo(year::class)->withDefault();
    }

    public function service()
    {
        return $this->hasMany(ServiceStudent::class, 'consult_id')->orderBy('created_at', 'desc');
    }
    public function serviceActive()
    {
        return $this->hasMany(ServiceStudent::class,'consult_id')->where('active',1);
    }


}
