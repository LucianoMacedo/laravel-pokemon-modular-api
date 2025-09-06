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

    public function getPokemon(int $id): PokemonDto
    {
        try {
            $response = $this->client->request('GET', "pokemon/{$id}");
            $data = json_decode($response->getBody()->getContents(), true);

            $pokemonData = [
                'number' => $id,
                'name' => $data['name'] ?? '',
                'base_experience' => $data['base_experience'] ?? 0,
            ];

            // Validar os dados
            PokemonValidator::validate($pokemonData);

            $pokemon = \App\Modules\Pokemon\Models\Pokemon::updateOrCreate(
                ['number' => $id],
                $pokemonData
            );

            return new PokemonDto($pokemon->number, $pokemon->name, $pokemon->base_experience);
        } catch (RequestException $e) {
            throw new \Exception("Erro ao buscar o Pokémon ID {$id}: " . $e->getMessage());
        }
    }

    public function updatePokemon(int $id, int $base_experience): PokemonDto
    {
        // Validar o ID
        $validatedId = PokemonValidator::validateId($id);

        $pokemon = Pokemon::where('number', $validatedId)->first();

        if (!$pokemon) {
            throw new \Exception("Pokémon com ID {$validatedId} não encontrado no banco de dados.");
        }

        $pokemon->base_experience = $base_experience;
        $pokemon->save();

        return new PokemonDto($pokemon->number, $pokemon->name, $pokemon->base_experience);
    }

    public function removePokemon(int $id): bool
    {
        // Validar o ID
        $validatedId = PokemonValidator::validateId($id);

        $pokemon = Pokemon::where('number', $validatedId)->first();

        if (!$pokemon) {
            throw new \Exception("Pokémon com ID {$validatedId} não encontrado no banco de dados.");
        }

        return $pokemon->delete();
    }

    public function removeAllPokemons(): int
    {
        return Pokemon::query()->delete();
    }
}
