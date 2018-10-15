# Desenvolvimento de metodologia e framework para elaboracão de modelos conceituais para sistemas de informação baseado em ontologias.

 
## Documentação 
* Ferramenta 1: Laravel 5.4+ / https://laravel.com/docs/5.7 
* Ferramente 2: AdminLTE / https://adminlte.io/themes/AdminLTE/pages/UI/general.html
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
##### Passo a passo . 
1. Clone o repositório para seu computador; 
2. Dentro da pasta principal do projeto crie um arquivo com o nome: **.env**; (Você pode pular os passos 2 e 3 entrando dentro da pasta através de um terminal e usando o comando "copy .env.example .env ")
3. Copie o conteúdo do arquivo **.env.example** para o arquivo **.env** recém criado; 
4. Acesse o repositório com um terminal e execute o comando: **composer install**; 
5. Ainda no terminal, gere uma application key com o comando: **php artisan key:generate**; 
6. Configure o arquivo **.env** com as configurações do banco de dados local; 
7. No terminal, execute as migrations com o comando: **php artisan migrate --seed**; 
8. Para executar o projeto, use o comando: **php artisan serve**.

#### Desenvolvimento 

* Algumas mudanças foram necessárias para a integração da biblioteca mxgraph com o laravel.

* 0. O arquivo index.blade.php é o arquivo principal do sistema e onde o diagrama é inicializado. Grande parte dos arquivos de JS são carregados aqui e por enquanto todas as relações (regras de negócio) são feitas no arquivo relation.js que é chamado no final da página. **CUIDADO AO ALTERAR**
* 1. Os arquivos de view (open.html / viewer.html) que deveriam estar localizados na pasta resources/views estão, por motivos de compatibilidade, localizados na pasta public.
* 2. A grande maioria de arquivos de javascript do mxgraph foi colocada e integrada a pasta public/js 
 padrão do laravel.
* 3. Imagens e gifs do mxgraph também foram inseridos na pasta public/js por motivos de integração.
* 4. A pasta public possui várias pastas a mais referentes ao mxgraph: " src ", "stencils", "examples","jscolor", "styles", "java", "sanitizer". **NÃO EXCLUIR**
* 5. Dentro da pasta public/css estão contidos uma série de arquivos referentes ao CSS utilizado no diagrama. Nessa pasta também se encontram gifs e imagens que também fazem parte de componentes do diagrama.
* 6. Foram realizadas uma série de mudanças no CSS do diagrama para que ele se encaixasse com o layout do sistema. Essas alterações podem ser vistas em public/css/mxgraph/grapheditor.css. (Estão separadas no final do arquivo).
* 7. A pasta config possui outra série de arquivos relacionados a compatibilidade do diagrama com o sistema.
* 9. Todo design do sistema foi desenvolvido para ser utilizado no modo top-nav do AdminLTE, trocar o estilo de menu irá acarretar em bugs.


*  As demais funcionalidades do sistema foram feitas utilizando as ferramentas padrões do laravel sem nenhum tipo de integração por cima.

#### Desenvolvido por Lucas Piazzi de Castro ####
