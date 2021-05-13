<p align="center">
<img src="public/css/images/Logo3.png"> 
 </p>
 <h3 align="center">
 OntoForALL é um editor gráfico com a capacidade de criar, editar e exportar ontologias para XML, OWL, SVG. Disponível em:
 <a href="https://onto4alleditor.com/">https://onto4alleditor.com/</a>
 </h3>
 
 


 
## Documentação 
* Ferramenta 1: Laravel 6.x+ / https://laravel.com/docs/6.x
* Ferramenta 2: AdminLTE / https://adminlte.io/themes/AdminLTE/pages/UI/general.html
* Ferramenta 3: mxGraph / https://jgraph.github.io/mxgraph/ 

### Guia de instalaçao 
#### Pré-requisitos 
* PHP: * Versão >= 7.1.3
* OpenSSL PHP Extension 
* PDO PHP Extension 
* Mbstring PHP Extension 
* Tokenizer PHP Extension 
* XML PHP Extension 
* Ctype PHP Extension 
* JSON PHP Extension + Banco de dados (MySQL, SQLite) + Servidor web (Apache)
* Composer. 

##### Passo a passo 

1. Clone o repositório para seu computador; 

2. Dentro da pasta principal do projeto crie um arquivo com o nome: **.env**; (Você pode pular os passos 2 e 3 entrando dentro da pasta através de um terminal e usando o comando "copy .env.example .env ")

3. Copie o conteúdo do arquivo **.env.example** para o arquivo **.env** recém criado; 

4. Acesse o repositório com um terminal e execute o comando: **composer install**; 

5. Ainda no terminal, gere uma application key com o comando: **php artisan key:generate**; 

6. Configure o arquivo **.env** com as configurações do banco de dados local; 

**Exemplo:**

````

DB_DATABASE=nome_do_seu_banco_de_dados

DB_USERNAME=seu_username

DB_PASSWORD=sua_password

````
 
7. No terminal, execute as migrations com o comando: **php artisan migrate --seed**; 

*Obs: A flag "--seed" serve apenas para seedar o banco, caso você não queira o banco preenchido remova essa flag do comando* 

8. Para executar o projeto, use o comando: **php artisan serve**;

10. Acesse a URL indicada no terminal;

#### Desenvolvimento 

* OntoForAll usa a biblioteca de Javascript mxGraph como componente principal para diagramação das ontologias, com o GraphEditor Example como base para tudo. O restante do projeto foi desenvolvido utilizando Laravel. O frontend foi feito utilizando o template AdminLTE2 como base.


#### Desenvolvido por Lucas Piazzi de Castro ####
