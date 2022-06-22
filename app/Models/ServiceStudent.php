<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceStudent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'service_student';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class)->withDefault();
    }

    public function service()
    {
        return $this->belongsTo(service::class)->withDefault();
    }

    public function consult()
    {
        return $this->belongsTo(consult::class, 'consult_id', 'id')->withDefault();
    }

    public function finance()
    {
        return $this->hasMany(FinanceSection::class, 'service_student_id');
    }

    public function financeConsult()
    {
        $type = FinanceSectionType::where('name', 'consult')->pluck('id')->first();
        return $this->hasOne(FinanceSection::class, 'service_student_id')->where('type_id', $type)->withDefault();
    }
    public function financeStudent()
    {
        $type = FinanceSectionType::where('name', 'student')->pluck('id')->first();
        return $this->hasOne(FinanceSection::class, 'service_student_id')->where('type_id', $type)->withDefault();
    }
    public function financeCaller()
    {
        $type = FinanceSectionType::where('name', 'caller')->pluck('id')->first();
        return $this->hasOne(FinanceSection::class, 'service_student_id')->where('type_id', $type)->withDefault();
    }
    public function financeManager()
    {
        $type = FinanceSectionType::where('name', 'manager')->pluck('id')->first();
        return $this->hasOne(FinanceSection::class, 'service_student_id')->where('type_id', $type)->withDefault();
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}
