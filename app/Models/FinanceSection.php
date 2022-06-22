<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceSection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(ServiceStudent::class,'service_student_id')->withDefault()->orderBy('student_id');
    }

}
