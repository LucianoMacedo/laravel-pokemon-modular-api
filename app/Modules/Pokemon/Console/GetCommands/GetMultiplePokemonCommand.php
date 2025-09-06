<?php

namespace App\Modules\Pokemon\Console\GetCommands;

use Illuminate\Console\Command;
use App\Modules\Pokemon\Models\Pokemon;
use App\Modules\Pokemon\Service\PokemonService;
use Illuminate\Support\Facades\Log;
use Exception;

class GetMultiplePokemonCommand extends Command
{
    protected $signature = 'pokemon:get-multiple {quantity}';
    protected $description = 'Busca múltiplos Pokémons da API e salva no banco de dados';
    public function handle(PokemonService $service)
    {
        $quantity = (int) $this->argument('quantity');

        if ($quantity <= 0) {
            $this->error("A quantidade deve ser um número positivo.");
            return;
        }

        for ($i = 1; $i <= $quantity; $i++) {
            try {
                $pokemon = $service->getPokemon($i);
                $this->info("Pokémon {$pokemon->name} (#{$i}) salvo com sucesso!");
            } catch (Exception $e) {
                Log::error("Erro ao buscar o Pokémon com ID {$i}: " . $e->getMessage());
                $this->error("Erro ao buscar o Pokémon com ID {$i}. Verifique os logs.");
            }
        }
    }
}
