<?php

namespace App\Modules\Pokemon\Helper;

class StringHelper
{
    public function formatPokemonName(string $name): string
    {
        return ucfirst(strtolower($name));
    }
}
