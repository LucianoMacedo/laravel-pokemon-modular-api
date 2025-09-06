<?php

namespace App\Modules\Pokemon\Validator;

use Illuminate\Support\Facades\Validator;

class PokemonValidator
{
    public static function validate(array $data): array
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'base_experience' => 'required|integer|min:0',
            'number' => 'required|integer|min:1',
        ])->validate();
    }
    public static function validateId($id): int
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|min:1',
        ])->validate();

        return $validated['id'];
    }
}
