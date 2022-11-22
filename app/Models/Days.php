<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    const MONDAY = 1;
    const TUESDAY = 2;
}
