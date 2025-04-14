
![NOMAD](./public/assets/admin/images/logo.png)

# Gerenciador - Laravel

  - [1. Configuração Inicial](#1-configuração-inicial)
    - [1.1 Configuração do Ambiente](#11-configuração-do-ambiente)
    - [1.2 Configuração do Projeto](#12-configuração-do-projeto)

## 1. Configuração Inicial

Nesta seção será demonstrado os passos necessários para a configuração do ambiente e do projeto em sua máquina.

### 1.1 Configuração do Ambiente

Os seguintes recursos são necessários para a configuração do ambiente:

* **Git** - [https://git-scm.com/download](https://git-scm.com/download)
* **Node** - [https://nodejs.org/](https://nodejs.org/)
* **PHP/MySQL** - [https://www.wampserver.com/](https://www.wampserver.com/)
* **Composer** - [https://getcomposer.org/download/](https://getcomposer.org/download/)
### 1.2 Configuração do Projeto

Faça o clone do projeto em sua máquina utlizando o comando:

```console
git clone https://github.com/wearenomad/laravel-base
```

Realize a instalação das dependências do composer:

```console
composer install
```

Realiza a instalação das dependências do npm:

```console
npm install
```

Realize a criação de um novo banco de dados no MySQL.

Com o banco de dados criado, modifique as configurações de conexão ao banco de dados no arquivo **.env**.
Caso o arquivo *.env* não exista criar a partir do *.env.example*

Realize a criação das tabelas e dados iniciais executando o comando:

```console
php artisan migrate
```

Sua aplicação já está configurada. Para acessar sua aplicação execute o comandao:

```console
php artisan serve
```

Com o comando acima em execução sua aplicação estará disponível a partir do link:

[http://localhost:8080/](http://localhost:8080/)

Para acessar o gerenciador da aplicação utilize as informações abaixo:

[http://localhost:8080/gerenciador/](http://localhost:8080/gerenciador/)
* **Usuário:** suporte@wearenomad.dev 
* **Senha:** #N0m@d

## 2. Criando o primeiro cadastro

### 2.1. Criando a migration

Para criar o cadastro no gerenciador criar primeiramente a migration:
*Substituir no comando o nome do projeto e da tabela*

```console
php artisan make:migration create_<projeto>_<tabela>_table
```

Com a migração criada os campos devem ser definidos no arquivo de migração gerado
O arquivo se localiza na pasta *database/migrations/*

Os campos podem ser de diversos tipos, os mais usados são:

* **$table->string('nome_campo')** - Gera um campo do tipo string
* **$table->string('nome_campo', *tamanho*)** - Gera um campo do tipo string com um tamanho definido
* **$table->text('nome_campo')** - Gera um campo do tipo texto (Para textos longos que necessitam de mais de 255 caracteres)
* **$table->boolean('nome_campo')** - Gera um campo do tipo boolean (true ou false)
* **$table->integer('nome_campo')** - Campos numéricos inteiros

Para mais tipos verificar a documentação completa do Laravel:

[https://laravel.com/docs/8.x/migrations#available-column-types](https://laravel.com/docs/8.x/migrations#available-column-types)

Os campos tambem podem ser nulos, ou seja, não serem obrigatórios, informando o tipo nullable na migration:

* **$table->string('nome_campo')->nullable()** - Define o campo como não obrigatório

Ao finalizar a definição dos campos rodar o comando abaixo para aplicar:

```console
php artisan migrate
```

Após, verificar no banco de dados se a tabela foi criada.

### 2.2. Criando o model

Com a tabela criado no banco de dados podemos criar o model para o acesso aos dados pela aplicação
Os models se localizam no diretório *app/Models/*
O model sempre deve ser criado seguindo a nomenclatura com o nome da tabela + a palavra Model

Abaixo o código base do model:

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaModel extends Model
{
    protected $table = 'prefixo_tabela';

    protected $fillable = [
        'nome_campo',
        'nome_campo_2'
    ];
}
```
Devem ser informados o nome da tabela na variavel *$table* e os campos criados na migration devem ser listados na variavel *$fillable*


### 2.3. Criando o controller

Com o model criado podemos gerar o controlador que criará o módulo do gerenciador responsavel por gerenciar os dados
Os controllers se localizam no diretório *app/Http/Controllers/Admin/*
O controller sempre deve ser criado seguindo a nomenclatura com o nome da tabela + a palavra Controller

Abaixo o código base do controller:

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Models\TabelaModel;

class TabelaController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = TabelaModel::class;

        $this->title = 'Titulo';

        $this->form = [ /* ... */ ];
    }
}
```

Após o código é configurado de modo a atender a necessidade de cada cadastro
Inicialmente são configuradas as váriaveis model, referenciando o model criado no passo anterior, e a variável title, definindo o título que aparecerá para o usuário

Abaixo uma lista das opções disponíveis no controller:

* **unique** - *true ou false* - Desabilita a listagem e cria um cadastro de registro único. Padrão: false 
* **sortable** - *nome do campo* - Habilita a função de reordenação para o usuário
* **order** - *nome do campo* - Ordena os registros com base no campo informado
* **pagination** - *true ou false* - Habilita a paginação. Padrão: true 
* **page_num** - *int* - Altera o número de registros por página. Padrão: 10
* **search** - *nome do campo* - Habilita a busca para o campo informado
* **add** - *true ou false* - Habilita o cadastro de registros. Padrão: true 
* **edit** - *true ou false* - Habilita a edição de registros. Padrão: true 
* **delete** - *true ou false* - Habilita a remoção de registros. Padrão: true 

Ainda há outras opções para as contruções das telas de listagem, cadastro e exportação

* **form** - *lista[]* - Informa os campos para a montagem dos formulários de cadastro
* **table** - *lista[]* - Informa as colunas da tabela da listagem
* **tabs** - *lista[]* - Informa as abas do cadastro
* **view** - *lista[]* - Informa os campos de visualização do cadastro
* **export** - *lista[]* - Informa os campos para exportaçãod o cadastro

