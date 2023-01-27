<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;;

class Student extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;
    
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];
}