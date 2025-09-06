<?php

namespace App\Modules\Pokemon\Console\GetCommands;

use Illuminate\Console\Command;
use App\Modules\Pokemon\Models\Pokemon;

class UpdatePokemonCommand extends Command
{
    protected $signature = 'pokemon:update {id} {base_experience}';
    protected $description = 'Atualiza o base_experience de um Pokémon existente no banco';

    public function handle()
    {
        $id = $this->argument('id');
        $base_experience = $this->argument('base_experience');

        $pokemon = Pokemon::find($id);

        if (!$pokemon) {
            $this->error("Pokémon não encontrado!");
            return;
        }

        $pokemon->update([
            'base_experience' => $base_experience
        ]);

        $this->info("Pokémon {$pokemon->name} atualizado com base_experience = {$pokemon->base_experience}");
    }
}
