<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtiesTeacher extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Lesson::class , 'lesson_id' , 'id');
    }
}
