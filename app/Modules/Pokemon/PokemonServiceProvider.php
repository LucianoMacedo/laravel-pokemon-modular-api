<?php

namespace App\Modules\Pokemon;

use App\Modules\Pokemon\Console\GetCommands\GetMultiplePokemonCommand;
use App\Modules\Pokemon\Console\GetCommands\GetPokemonAllCommand;
use Illuminate\Support\ServiceProvider;
use App\Modules\Pokemon\Console\GetCommands\GetPokemonCommand;
use App\Modules\Pokemon\Console\GetCommands\RemoveAllPokemonCommand;
use App\Modules\Pokemon\Console\GetCommands\UpdatePokemonCommand;

class PokemonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/pokemon.php', 'pokemon');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GetPokemonAllCommand::class,
                UpdatePokemonCommand::class,
                RemoveAllPokemonCommand::class,
            ]);
        }

        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
    }
}
