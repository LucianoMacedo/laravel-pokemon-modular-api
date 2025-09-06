<?php

namespace App\Modules\Pokemon\Console\GetCommands;

use Illuminate\Console\Command;
use App\Modules\Pokemon\Service\PokemonService;
use Illuminate\Support\Facades\Log;
use Exception;

class GetPokemonAllCommand extends Command
{
    protected $signature = 'pokemon:get-all';
    protected $description = 'Busca todos os Pokémons da API e salva no banco de dados';
    public function handle(PokemonService $service)
    {
        for ($i = 1; $i <= 151; $i++) {
            try {
                $pokemon = $service->getAllPokemon($i);
                $this->info("Pokémon {$pokemon->name} (#{$i}) salvo com sucesso!");
            } catch (Exception $e) {
                Log::error("Erro ao buscar o Pokémon com ID {$i}: " . $e->getMessage());
                $this->error("Erro ao buscar o Pokémon com ID {$i}. Verifique os logs.");
            }
        }
    }
}
