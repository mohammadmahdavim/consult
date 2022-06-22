<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'family',
        'role',
        'gender',
        'email',
        'password',
        'national_code',
        'email',
        'mobile',
        'active',
        'section',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function consult()
    {
        return $this->hasOne(consult::class)->withDefault();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function finance()
    {
        return $this->hasMany(FinanceSection::class);
    }

    public function transaction()
    {
        return $this->hasOne(transaction::class);
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class)->withDefault();
    }
}
