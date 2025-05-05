# Projeto E-commerce Laravel

Este é um projeto de e-commerce desenvolvido com **Laravel**. Abaixo você encontra as instruções de como rodar o projeto em sua máquina local.

## Requisitos

Antes de começar, você precisará ter os seguintes programas instalados:

-   [WampServer](https://www.wampserver.com/en/) (Inclui PHP, MySQL e Apache)
-   [Composer](https://getcomposer.org/) (Gerenciador de dependências PHP)
-   [Node.js](https://nodejs.org/) (Para gerenciar dependências JavaScript)

## Como rodar

### 1. Clonar o repositório

Clone o repositório do projeto para sua máquina local utilizando o comando:

```bash
git clone https://github.com/wearenomad/laravel-base
```

### 2. Instalar as dependências do Composer

Navegue até o diretório do projeto e execute o comando abaixo para instalar as dependências do **Composer**:

```bash
cd laravel-base
composer install
```

### 3. Instalar as dependências do NPM

Execute o seguinte comando para instalar as dependências do **Node.js**:

```bash
npm install
```

### 4. Criar o banco de dados

Crie um banco de dados no **MySQL** utilizando o **WampServer** (ou qualquer outro servidor MySQL que você esteja usando).

### 5. Configurar o arquivo `.env`

No diretório raiz do projeto, você encontrará o arquivo `.env.example`. Renomeie-o para `.env` e configure as informações de conexão com o banco de dados, como host, nome do banco, usuário e senha. Exemplo:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Criar as tabelas e dados iniciais

Com o banco de dados configurado, crie as tabelas e dados iniciais executando o seguinte comando:

```bash
php artisan migrate
```

### 7. Rodar o servidor

Agora, sua aplicação Laravel está configurada. Para iniciar o servidor e acessar sua aplicação localmente, execute o comando:

```bash
php artisan serve
```

A aplicação estará acessível em `http://127.0.0.1:8000`.

### 8. Rodar o Watcher do NPM

Para compilar os arquivos do frontend e observar as mudanças no código, execute o seguinte comando:

```bash
npm run watch
```

---

## Considerações Finais

-   Certifique-se de que o **WampServer** está rodando para que o Apache e o MySQL funcionem corretamente.
-   Se você encontrar algum erro relacionado à configuração do banco de dados, verifique as configurações no arquivo `.env`.
-   Para rodar em ambiente de produção, lembre-se de configurar corretamente o ambiente de produção no `.env` e executar os comandos de **migrate** e **optimize**.

Se você tiver alguma dúvida ou encontrar algum problema, sinta-se à vontade para abrir uma **issue** no repositório.

---

### Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
