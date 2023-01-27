<?php

namespace App\Models;

use Database\Seeders\SpecialtiesTeachers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;

use Spatie\MediaLibrary\InteractsWithMedia;

class Teacher extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, InteractsWithMedia;
    
    const AUTH = 'teacher-api';

    protected $guarded = [];
    protected $hidden = [
        'password',
    ];

    public function grades(){
        return $this->hasMany(Grade::class);
    }
    public function subjects(){
        return $this->hasMany(SpecialtiesTeacher::class)->with('subject');
    }
}