<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolworkStudentStatus extends Model
{
    use HasFactory;
    const DEFAULT = 1;
    
    protected $guarded = [];
}
