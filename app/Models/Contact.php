<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function FieldSchool()
    {
        return $this->belongsTo(FieldSchool::class,'field')->withDefault();
    }

    public function payeSchool()
    {
        return $this->belongsTo(Paye::class,'paye')->withDefault();
    }

public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
