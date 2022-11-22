<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolworkStatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    const DEFAULT = 1;
}
