<?php

namespace App\Modules\Pokemon\Providers\Dtos;

class PokemonDto
{
    public string $name;
    public int $base_experience;
    public int $number;

    public function __construct(string $name, int $base_experience, int $number)
    {
        $this->name = $name;
        $this->base_experience = $base_experience;
        $this->number = $number;
    }
}
