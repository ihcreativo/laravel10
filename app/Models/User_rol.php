<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_rol extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'user_rol';
    
    protected $fillable = [	
        'nivel','rol'
    ];
}
