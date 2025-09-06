<?php

namespace App\Modules\Pokemon\Console\GetCommands;

use Illuminate\Console\Command;
use App\Modules\Pokemon\Service\PokemonService;
use Illuminate\Support\Facades\Log;
use Exception;


class GetPokemonCommand extends Command
{
    protected $signature = 'pokemon:get {id}';
    protected $description = 'Busca Pokémon da API e salva no banco de dados';

    public function handle(PokemonService $service)
    {
        $id = $this->argument('id');
        $pokemon = $service->getPokemon($id);

        $this->info("Pokémon {$pokemon->name} salvo com sucesso!");
    }
}
