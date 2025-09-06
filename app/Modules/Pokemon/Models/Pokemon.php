<?php

namespace App\Modules\Pokemon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'pokemons';
    protected $fillable = [
        'name',
        'number',
        'base_experience',
    ];
}
