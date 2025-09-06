<?php

namespace App\Modules\Pokemon\Console\GetCommands;

use Illuminate\Console\Command;
use App\Modules\Pokemon\Models\Pokemon;
use App\Modules\Pokemon\Service\PokemonService;

class UpdatePokemonCommand extends Command
{
    protected $signature = 'pokemon:update {id} {base_experience}';
    protected $description = 'Atualiza o base_experience de um Pokémon existente no banco';

    public function handle(PokemonService $service)
    {
        $id = $this->argument('id');
        $base_experience = $this->argument('base_experience');

        try {
            $pokemon = $service->updatePokemon((int)$id, (int)$base_experience);
            $this->info("Pokémon {$pokemon->name} atualizado com base_experience = {$pokemon->base_experience}");
        } catch (\Exception $e) {
            $this->error("Erro: " . $e->getMessage());
        }
    }
}
