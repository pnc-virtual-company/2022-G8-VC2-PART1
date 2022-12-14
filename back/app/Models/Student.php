<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
        'class',
        'geration',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
