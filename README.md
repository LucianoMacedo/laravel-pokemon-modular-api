# Pokémon API com Laravel Modular

Este projeto foi desenvolvido para estudar **arquitetura modular no Laravel**, 
consumindo a [PokeAPI](https://pokeapi.co/) e salvando os dados no banco.

## 🚀 Tecnologias
- PHP 8.x
- Laravel 10.x
- MySQL
- Composer
- PokeAPI (API pública)

## 📂 Estrutura de pastas
app/Modules/Pokemon
├── Config/
├── Console/
│ └── GetCommands/
├── Database/
├── Helper/
├── Models/
├── Providers/
│ ├── shared/
│ ├── maps/
│ └── Dtos/
├── Service/
├── Validator/
└── PokemonServiceProvider.php
## ⚙️ Funcionalidades
- Consumir Pokémons da API externa via **Command (Artisan)**  
- Usar **DTOs** para transferir dados  
- Persistir no banco de dados com **Eloquent Models**  
- Separar responsabilidades com **Services e Providers**

## 📦 Como rodar o projeto
```bash
# Clonar o repositório
git clone https://github.com/SEU_USUARIO/laravel-pokemon.git

cd laravel-pokemon

# Instalar dependências
composer install

# Copiar variáveis de ambiente
cp .env.example .env

# Gerar key
php artisan key:generate

# Rodar migrations
php artisan migrate

# Rodar comando para importar Pokémons
php artisan pokemon:get-all
# Atualizar base_experience
php artisan pokemon:update 25 200
# Remove todos os Pokémons do banco
php artisan pokemon:remove-all 
