 <h1 align="center"> <strong> ONTO4ALL </strong> </h1>
 
 <h3 align="center">
 OntoForALL é um editor gráfico com a capacidade de criar, editar e exportar ontologias para XML, OWL, SVG.
 </h3>
 
 <p align="center">
          <img src="https://media.giphy.com/media/bqTHbDkxK4hZWmGHeO/giphy.gif"/>
</p>

 
<p align="center">
          <img src="https://media.giphy.com/media/1xOPY52mlgKp1wrsfm/giphy.gif"/>
</p>


 
## Documentação 
* Ferramenta 1: Laravel 5.4+ / https://laravel.com/docs/5.7 
* Ferramenta 2: AdminLTE / https://adminlte.io/themes/AdminLTE/pages/UI/general.html
* Ferramenta 3: mxGraph / https://jgraph.github.io/mxgraph/ 
* Ferramenta 4: Jquery / https://api.jquery.com/

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

* OntoForAll usa a biblioteca de Javascript mxGraph como componente principal para diagramação das ontologias, com o GraphEditor Example como base para tudo.

* Algumas mudanças foram necessárias para a integração da biblioteca mxgraph com o laravel.

* 0. O arquivo **index.blade.php** é o arquivo principal do sistema e onde o diagrama é inicializado. Grande parte dos arquivos de JS são carregados aqui. O arquivo possui também todo o menu de dicas (Sidebar) **CUIDADO AO ALTERAR**
* 1. Os arquivos de view (**open.html** / **viewer.html**) que deveriam estar localizados na pasta resources/views estão, por motivos de compatibilidade, estão localizados na pasta public.
* 2. A grande maioria de arquivos de javascript do mxgraph foi colocada e integrada a pasta public/js 
 padrão do laravel.
* 3. Imagens e gifs do mxgraph também foram inseridos na pasta public/js por motivos de integração.
* 4. A pasta public possui várias pastas a mais referentes ao mxgraph: " src ", "stencils", "examples","jscolor", "styles", "java", "sanitizer". **NÃO EXCLUIR**
* 5. Dentro da pasta public/css estão contidos uma série de arquivos referentes ao CSS utilizado no diagrama. Nessa pasta também se encontram gifs e imagens que também fazem parte de componentes do diagrama.
* 6. Foram realizadas uma série de mudanças no CSS do diagrama para que ele se encaixasse com o layout do sistema. Essas alterações podem ser vistas em public/css/mxgraph/grapheditor.css. (Estão separadas no final do arquivo).
* 7. A pasta config possui outra série de arquivos relacionados a compatibilidade do diagrama com o sistema.
* 9. Todo design do sistema foi desenvolvido para ser utilizado no modo top-nav do AdminLTE, trocar o estilo de menu irá acarretar em bugs.
* 10. O arquivo Dialogs.js foi modificado para receber novas propriedades("Domain", "Range") referentes as ontologias. A partir da **linha 1473**.
* 11. Dezenas de alterações foram feitas no CSS para encaixar a SideBar e as caixas de dicas. A maioria das mudanças feitas estão localizadas em **public/css/mxgraph/grapheditor.css**.

*  As demais funcionalidades do sistema foram feitas utilizando as ferramentas padrões do laravel sem nenhum tipo de integração por cima.

### Mapeamento de Arquivos

    Principais arquivos:
    
* **resources/views/index.blade.php** - Principal arquivo do sistema onde é carregado grande parte do javascript e várias componentes como menus e dicas.
* **public/Actions.js** - Define as ações (Atalhos) do editor como Salvar, importar, exportar, etc...
* **public/Dialogs.js** - Define e implementa as caixas de dialog (modal) e as suas respectivas funções (Ex: Exportar, Salvar, Importar) **IMPORTANTE**.
* **public/EditorUI.js** - Onde está localizada a função de salvar em XML do editor. **EditorUI.prototype.saveXML**.  **IMPORTANTE**
* **public/Init.js** - Onde está definido as rotas para algumas funções do diagrama.
* **public/SearchTip** - Contém as funções de busca/filtro de dicas da sidebar de dicas do editor.
* **public/SearchBar** - Contém a função de filtro de todos os CRUD's.
* **public/css/mxgraph/grapheditor.css**- Contém todas as alterações feitas para encaixar o editor com o tema do adminlte.
* **public/css/resources/grapheditor.txt** - Contém os nomes de todos os botões e funções do diagrama.
* **app/Http/Controllers/HomeController** - É o controller que gerencia as principais funções de salvar e exportar do editor.

#### Desenvolvido por Lucas Piazzi de Castro ####
