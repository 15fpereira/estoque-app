### Incicio do projeto Laravel + Sail + React + Vite

## NOME DO PROJETO: Estoque-app

Proximo passo Instalar o BluePrint

> ✅ 1. Antes de tudo, inicie o Sail!:
```bash
bash

sail up -d
```
> ✅ 2. Executar Comando de Instalação:
```bash
bash

sail composer require --dev laravel-shift/blueprint
```
> ✅ 3. Executar blueprint com esse arquivo limpo, considerando que possue o aarquivo: draft.yml na raiz do projeto
```bash
bash

./vendor/bin/sail artisan blueprint:build

```
## Isso vai gerar:

+ Migrations

+ Models

+ Controllers com métodos resource

+ Form Requests

+ Filament Resources (se você quiser usar Filament)

Seeders

> ✅ 4. Execute Migrations e Seeders:

```bash
bash

./vendor/bin/sail artisan migrate --seed
```
blueprint (v2.12.0)