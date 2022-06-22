<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }


    public function type()
    {
        return $this->belongsTo(TaskType::class,'task_type_id');
    }
}
