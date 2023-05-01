# Sistema de Gerenciamento de Pessoas e Contatos

Este projeto é um simples sistema de gerenciamento de pessoas e contatos, desenvolvido utilizando PHP e o framework Doctrine ORM.

## Requisitos

- PHP 8.0 ou superior
- MySQL
- Composer

## Instalação

1. Clone o repositório:
git clone https://github.com/sebet89/magazord_teste.git

2. Instale as dependências do projeto com o Composer:
cd magazord_teste
composer install

3. Configure o acesso ao banco de dados editando o arquivo `config.php`:
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'banco_teste',
    'user'     => 'seu_user',
    'password' => 'seu_password',
);

Execute as migrações do banco de dados para criar as tabelas necessárias:
php vendor/bin/doctrine orm:schema-tool:update --force


4. Execute o servidor PHP embutido:
php -S localhost:8000 -t public
Acesse o sistema no navegador através do endereço http://localhost:8000

## Testes
Para executar os testes, utilize o PHPUnit:
vendor/bin/phpunit