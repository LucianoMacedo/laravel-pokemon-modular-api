<?php

namespace App\Modules\Pokemon\Providers\Dtos;

class PokemonDto
{
    public int $number;
    public string $name;
    public int $base_experience;

    public function __construct(array $data)
    {
        $this->number = $data['number'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->base_experience = $data['base_experience'] ?? 0;
    }
}
