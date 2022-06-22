<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taraz extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function testName()
    {
        return $this->belongsTo(Test::class,'test_id');
    }

    public function authortaraz()
    {
        return $this->belongsTo(User::class,'author');
    }
}
