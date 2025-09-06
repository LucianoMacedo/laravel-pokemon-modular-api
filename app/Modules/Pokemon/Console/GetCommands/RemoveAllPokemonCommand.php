<?php

namespace App\Modules\Pokemon\Console\GetCommands;

use Illuminate\Console\Command;
use App\Modules\Pokemon\Models\Pokemon;

class RemoveAllPokemonCommand extends Command
{
    protected $signature = 'pokemon:remove-all';
    protected $description = 'Remove todos os Pokémons do banco';

    public function handle()
    {
        Pokemon::truncate();
        $this->info("Todos os Pokémons foram removidos do banco.");
    }
}
