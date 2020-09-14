# Potential CRUD

* Configurações recomendadas
  * docker-compose versão 1.26.1
  * Docker versão 19.03.12 
  
* Para iniciar o projeto basta executar o `docker-compose up`, esse comando já possui todas as instruções no arquivo 
docker-compose.yml para instalar todas as dependencias, criar o banco de dados e iniciar o server para as aplicações de
**front** e **api**

## API
### Detalhes da implementação

* Foi utilizado para implementar a API o framework Laravel, utilizando a linguagem de programação **PHP 7.4**, a API 
esta dividida nas seguintes camadas: 
  * **Routes** em `routes/api.php`
  * **Requests** em `app/Http/Requests`
    * É uma camada de validação 
  * **Controllers** em `app/Http/Controllers` 
  * **Services** em `app/Services`
  * **Repositories** em `app/Repositories`
  * **Models** em `app/Models`
  * **Factories** em `app/database/factories` 
     * Padrão para a criação dos models para utilizar em ambiente de teste, sendo os metodos `make` sem persistencia e `create` 
     com persistencia no banco.
  * **Migrations** em `app/database/migrations`
  * **Tests** em `tests/Feature` para testes de integração e `tests/Unit` para visualizar os testes unitários

### Postman

* Você pode baixar uma collection do postman para testar os endpoints da API [Clicando aqui](https://www.getpostman.com/collections/90b9c140a92c4175ed70)

### Testes na API

 Executar os testes unitários:
  * `docker exec -it potential_api phpunit --configuration phpunit.xml --testsuit=Unit`
  
 Executar os testes de integração:
  * `docker exec -it potential_api phpunit --configuration phpunit.xml --testsuit=Feature`
  
## Front
  * O front foi implementado utilizando **React** 
## Hosts

* API `http://localhost:88`
* Front `http://localhost:3000/`

[sds]: https://www.getpostman.com/collections/90b9c140a92c4175ed70