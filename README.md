# Desenvolvimento de metodologia e framework para elaboracão de modelos conceituais para sistemas de informação baseado em ontologias.

 
## Documentação 
* Ferramenta 1: Laravel 5.4+ / https://laravel.com/docs/5.7 
* Ferramente 2: AdminLTE / https://adminlte.io/themes/AdminLTE/pages/UI/general.html

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
##### Passo a passo . 
1. Clone o repositório para seu computador; 
2. Dentro da pasta principal do projeto crie um arquivo com o nome: **.env**; 
3. Copie o conteúdo do arquivo **.env.example** para o arquivo **.env** recém criado; 
4. Acesse o repositório com um terminal e execute o comando: **composer install**; 
5. Ainda no terminal, gere uma application key com o comando: **php artisan key:generate**; 
6. Configure o arquivo **.env** com as configurações do banco de dados local; 
7. No terminal, execute as migrations com o comando: **php artisan migrate --seed**; 
8. Para executar o projeto, use o comando: **php artisan serve**.



#### Desenvolvido por Lucas Piazzi de Castro ####
