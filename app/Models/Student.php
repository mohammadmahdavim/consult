<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function callerStudent()
    {
        return $this->belongsTo(User::class,'caller')->withDefault();
    }


    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id')->withDefault();
    }


    public function super_consult()
    {
        return $this->belongsTo(User::class,'super_consult_id')->withDefault();
    }

    public function consult()
    {
        return $this->belongsTo(consult::class)->withDefault();
    }


    public function field()
    {
        return $this->belongsTo(FieldSchool::class)->withDefault();
    }

    public function paye()
    {
        return $this->belongsTo(Paye::class)->withDefault();
    }

    public function state()
    {
        return $this->belongsTo(state::class)->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(state::class)->withDefault();
    }

    public function service()
    {
        return $this->hasMany(ServiceStudent::class,'student_id')->orderBy('created_at','desc');
    }

    public function serviceActive()
    {
        return $this->hasOne(ServiceStudent::class,'student_id')->where('active',1)->withDefault();
    }

    public function serviceLast()
    {
        return $this->hasOne(ServiceStudent::class,'student_id')->orderBy('created_at','desc')->withDefault();
    }

    public function serviceFirst()
    {
        return $this->hasOne(ServiceStudent::class,'student_id')->orderBy('created_at','asc')->withDefault();
    }
}
