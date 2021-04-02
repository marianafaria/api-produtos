Scrap de Produtos

- URL utilizada: https://www.amazon.com.br/Xiaomi-Vers%C3%A3o-Global-Lacrada-preta/dp/B07V822TVL

Pré requisitos:
 * Composer instalado.
 * PHP 7.3 ou superior.

Instalação após o clone do projeto:

composer install
composer dump
criar arquivo .env (neste arquivo deve conter as informações do banco de dados)
php artisan key:generate
php artisan migrate
php artisan serve (caso você já tenha um localhost configurado em sua maquina não é preciso executar o serve)

Link utilizado para teste da API: http://localhost/api-produtos/public/api/produtos/
