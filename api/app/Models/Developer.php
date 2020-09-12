<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected array $fillable = [
        'nome',
        'sexo',
        'idade',
        'hobby',
        'data_nascimento'
    ];
}