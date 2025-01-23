<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_opcion extends Model
{
    use HasFactory;
    protected $table = "entrada_opcion";
    protected $fillable = [
        'id',
        'opcion',
        'id_user'
    ];
}
