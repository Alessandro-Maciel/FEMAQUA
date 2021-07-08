# Sobre a API

A aplicação é um simples repositório para gerenciar ferramentas com seus respectivos nomes, links, descrições e tags construída utilizando:

- [Laravel - versão 7](https://laravel.com).
- [MySql - versão 5.7](https://www.mysql.com/).

A documentação completa para ultilização de rotas poderá ser acessada no diretório storage/api-docs/api-docs.json. Ou se preferir, acessando o link http://localhost:3000/api/doc após instalação.

## Requisitos necessários para instalação

- [Composer](https://getcomposer.org/).
- [MySql](https://downloads.mysql.com/archives/community/).
- [Git](https://git-scm.com/).

## Requisitos opcionais

- [Postman](https://www.postman.com/downloads/).

O Postman é uma ferramenta que dá suporte à requisições feitas pela API, execução de testes e requisições em geral.

Você também pode testar as requisições diretamente na documentação da api no link http://localhost:3000/api/doc após a instalão e configuração.


## Como instalar e configurar o ambiente

* 1 Clone o repositório usando o git em seu computador.
* 2 Abra o terminal e navegue até a pasta FEMAQUA que foi criada.
* 3 Com o [Composer](https://getcomposer.org/) já instalado na maquina, execute o comando abaixo e aguarde o término de instalação das dependências. 
```
 composer install 

``` 
* 4 Após a intalação, execute o comando no terminal.
``` 
copy .env.example .env
php artisan key:genarate 

```
* 5 Tendo instalado o mysql na sua máquina, crie uma base de dados com o nome de sua preferência. (exemplo: "api") no formato **utf8_general_ci**.
* 6 Abra o arquivo **.env** e sete os valores para conexão do banco de dados:
    * DB_CONNECTION=mysql
    * DB_HOST=127.0.0.1
    * DB_PORT=3306
    * DB_DATABASE=laravel
    * DB_USERNAME=root
    * DB_PASSWORD=
* 7 Setado os valores de conexão, execute os comandos no terminal:
``` 
php artisan migration
php artisan db:seed

```

Os comandos acima irão criar as tabelas e popular o banco com os registros iniciais.

* 8 Execute o comando abaixo para da start no serve:
``` 
php artisan serve --port=3000

```

## Testando a api

Acesse o link http://localhost:3000/api/doc para consultar as rotas disponíveis. Você poderá consumir-las aparti da documentação ou se preferir use a ferramenta de sua preferência, como exemplo o [Postman](https://www.postman.com/downloads/).

