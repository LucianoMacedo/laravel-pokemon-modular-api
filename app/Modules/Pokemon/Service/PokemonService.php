<?php

namespace App\Modules\Pokemon\Service;

use App\Modules\Pokemon\Models\Pokemon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Modules\Pokemon\Providers\Dtos\PokemonDto;
use App\Modules\Pokemon\Validator\PokemonValidator;

class PokemonService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('pokemon.api_url'),
            'timeout'  => 5.0, // tempo máximo de espera
        ]);
    }

    public function getAllPokemon(int $id)
    {
        $response = $this->client->request('GET', "pokemon/{$id}");
        $data = json_decode($response->getBody()->getContents(), true);

        return Pokemon::updateOrCreate(
            ['number' => $id], // Evita duplicar
            [
                'name' => $data['name'] ?? '',
                'base_experience' => $data['base_experience'] ?? 0,
            ]
        );
    }

    public function updatePokemon(int $id, int $base_experience): PokemonDto
    {
        $pokemon = Pokemon::findOrFail($id);

        $pokemon->update([
            'base_experience' => $base_experience,
        ]);

        return new PokemonDto([
            'number' => $pokemon->number,
            'name' => $pokemon->name,
            'base_experience' => $pokemon->base_experience,
        ]);
    }

    public function removeAllPokemons(): int
    {
        return Pokemon::query()->delete();
    }
}
