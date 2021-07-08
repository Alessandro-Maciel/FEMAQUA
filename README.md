# Sobre a API

A aplicação é um simples repositório para gerenciar ferramentas com seus respectivos nomes, links, descrições e tags construída utilizando:

- [Laravel - versão 7](https://laravel.com).
- [MySql - versão 5.7](https://www.mysql.com/).

A documentação completa para ultilização de rotas poderá ser acessada no diretório storage/api-docs/api-docs.json. Ou se preferir, acessando o link http://localhost:3000/api/doc após instalação.

## Requisitos necessários para instalação

- [Composer](https://getcomposer.org/).
- [MySql](https://downloads.mysql.com/archives/community/).
- [Git - versão 2.19.2](https://git-scm.com/).

O composer irá gerenciar todas as dependências necessários para a execução da api.

MySql é o banco de dados onde irá persistir os dados.

## Requisitos opcionais

- [Postman](https://www.postman.com/downloads/).

O Postman é uma ferramenta que dá suporte à requisições feitas pela API, execução de testes e requisições em geral.

Você também pode testar as requisições diretamente na documentação da api no link http://localhost:3000/api/doc após a instalão e configuração.


## Como instalar e configurar o ambiente

* 1 Clone o repositório usando o git em seu computador.
* 2 Abra o terminal e navegue até a pasta FEMAQUA que foi criada.
* 3 Com o [Composer](https://getcomposer.org/) já instalado na maquina, execute o comando ``` composer install ``` e aguarde o término de instalação das dependências. 
* 4 Após a intalação, execute o comando ``` copy .env.example .env ``` no terminal.
* 5 Tendo instalado o mysql na sua máquina, crie uma base de dados com o nome de sua preferência. (exemplo: "api") no formato **utf8_general_ci**.
* 6 Abra o arquivo **.env** e sete os valores para conexão do banco de dados:
    *DB_CONNECTION=mysql
    *DB_HOST=127.0.0.1
    *DB_PORT=3306
    *DB_DATABASE=laravel
    *DB_USERNAME=root
    *DB_PASSWORD=
* 7 - Setado os valores para conexão, execute o comando no terminal 
``` 
php artisan migration
php artisan db:seed

```

* 8 - 

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
