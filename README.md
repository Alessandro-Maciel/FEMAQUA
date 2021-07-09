# Sobre a API

A aplicação é um simples repositório para gerenciar ferramentas com seus respectivos nomes, links, descrições e tags construída utilizando:

- [Laravel - versão 7 / PHP - versão 7.4.16](https://laravel.com).
- [MySql - versão 5.7.24](https://www.mysql.com/).

A documentação completa para ultilização de rotas poderá ser acessada no diretório storage/api-docs/api-docs.json. Ou se preferir, acessando o link http://localhost:3000/api/doc após instalação.

## Requisitos necessários para instalação

- [Php](https://www.php.net/ChangeLog-7.php#7.4.16).
- [Composer](https://getcomposer.org/download/).
- [MySql](https://downloads.mysql.com/archives/community/).

Se preferir mais comodidate, baixe o [laragon](https://laragon.org/download/), um ambiente de desenvolvimento universal. Ele vem com todas as ferramentas acima, e se trata de um ambiente isolado e sem conflitos.

- [Git](https://git-scm.com/).

## Requisitos opcionais

- [Postman](https://www.postman.com/downloads/).

O Postman é uma ferramenta que dá suporte à requisições feitas pela API, execução de testes e requisições em geral.

Você também pode testar as requisições diretamente na documentação da api no link http://localhost:3000/api/doc após a instalação e configuração.

## Como instalar e configurar o ambiente

* Clone o repositório usando o git em seu computador.
* Abra o terminal e navegue até a pasta FEMAQUA que foi criada.
* Com o [Composer](https://getcomposer.org/) já instalado na maquina, execute o comando abaixo e aguarde o término de instalação das dependências. 
```
 composer install 

``` 
* Após a intalação, execute os comandos abaixo no terminal:
``` 
copy .env.example .env

```
``` 
php artisan key:generate 

```
* Tendo instalado o mysql na sua máquina, crie uma base de dados com o nome de sua preferência. (exemplo: "api") no formato **utf8_general_ci**.
* Abra o arquivo **.env** e sete os valores para conexão do banco de dados:
    * DB_HOST=127.0.0.1
    * DB_PORT=3306
    * DB_DATABASE=
    * DB_USERNAME=root
    * DB_PASSWORD=
* Setado os valores de conexão, execute os comandos no terminal:
``` 
php artisan migrate
php artisan db:seed

```

Os comandos acima irão criar as tabelas e popular o banco com os registros iniciais.

* Execute o comando abaixo para gerar a chave **JWT_SECRET** no aquivo **.env**.

```
php artisan jwt:secret
```

* Execute o comando abaixo para da start no serve na porta 3000:
``` 
php artisan serve --port=3000

```

## Testando a api

Para consumir todas as rotas disponíveis faça login na rota **/auth/login** com as credenciais de acesso abaixo:
``` 
email: admin@admin.com
password: admin123

```
deverá retornar 'access_token'.

Acesse o link http://localhost:3000/api/doc para consultar as rotas disponíveis. Você poderá consumir-las aparti da documentação ou se preferir use a ferramenta de sua preferência, como exemplo o [Postman](https://www.postman.com/downloads/).

