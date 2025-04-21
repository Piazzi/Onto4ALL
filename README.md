<p align="center">
  <img src="public/css/images/Logo3.png"> 
</p>
<h2 align="center">
  Onto4ALL is a FREE graphical editor for creating, editing, and exporting ontologies to <b>XML</b>, <b>OWL</b>, and <b>SVG</b>.
</h2>

<h3 align="center" style="margin-top: 10px;">
  🔗 <b>Access the editor for free:</b> 
  <a href="https://onto4alleditor.com/" style="color: #2d3748; background-color: #e2e8f0; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; border: 1px solid #cbd5e0;">
    https://onto4all.com/
  </a>
</h3>

## Main Features

### 🎨 Full Graphical Editor  
Draw any ontology you want, the way you want. Intuitive drag-and-drop interface with customizable nodes and relationships.

### 📂 Ontology Manager  
Save, view, and edit your ontologies in our built-in manager. Access your projects later with just one click.

### 📤 Export  
Export your ontology to multiple formats:  
- **OWL** (Web Ontology Language)  
- **XML** (Structured data)  
- **SVG** (Scalable vector graphics for diagrams)  

### ⚠️ Warnings Console  
Build better ontologies with real-time feedback. The console suggests modeling best practices and detects inconsistencies.

### ✍️ Class Expression Editor  
Write correct class axioms effortlessly with guided syntax support and auto-completion.

### 👩‍💻 User-Friendly Design  
Designed for **everyone**—from beginners learning ontologies to advanced researchers. Clean UI with contextual help.

### 📚 Thesaurus Editor  
Includes a simple yet powerful thesaurus editor for lightweight vocabulary management.

### 💡 Tips Menu  
Quick-access knowledge base for reference ontologies:  
- **BFO** (Basic Formal Ontology)  
- **IAO** (Information Artifact Ontology)  
- **IOF** (Industrial Ontologies Foundry)

## Papers Published

### 2021  
- **MENDONÇA, F. M.; CASTRO, L. P.**  
  **OntoForInfoScience e Onto4ALLEditor: metodologia e editor de ontologias como facilitadores na construção de ontologias por especialistas do domínio e cientistas da informação.**  
  *Fronteiras da Representação do Conhecimento (online)*, v. 1, p. 145-173, 2021.  
  [DOI/Link](https://periodicos.ufmg.br/index.php/advances-kr/article/download/35446/28128/109983)  

- **MENDONÇA, F. M.; EMYGDIO, J. L.; CASTRO, L. P.; FELIPE, E. R.**  
  **Onto4ALLEditor: a Graphic Web Ontology Editor for Information Science.**  
  *Fronteiras da Representação do Conhecimento (online)*, v. 1, p. 70-94, 2021.  
  [DOI/Link](https://periodicos.ufmg.br/index.php/advances-kr/article/view/37542)  

- **MENDONÇA, F. M.; CASTRO, L. P.; SOUZA, J. F.; ALMEIDA, M. B.; FELIPE, E. R.**  
  **Onto4AllEditor: um editor web gráfico para construção de ontologias por todos os tipos de usuários da informação.**  
  *EM QUESTÃO*, v. 27, p. 401-430, 2021.  
  [DOI/Link](https://seer.ufrgs.br/EmQuestao/article/view/105603)  

### 2020  
- **MENDONÇA, F. M.; CASTRO, L. P.; SOUZA, JAIRO; ALMEIDA, M. B.; FELIPE, E. R.**  
  **(Onto4AllEditor: A Graphical Web Ontology Editor Oriented Different Types of Ontology Developers).**  
  In: *XIII Seminar on Ontology Research in Brazil (ONTOBRAS 2020)*, Vitória - ES. *Proceedings of the XIII Seminar on Ontology Research in Brazil*, 2020. v. 1, p. 104-119.  
  [DOI/Link](https://ceur-ws.org/Vol-2728/paper8.pdf)  

## Documentation  
* **Tool 1:** <a href="https://laravel.com/docs/6.x" target="_blank">Laravel 6.x+</a>  
* **Tool 2:** <a href="https://adminlte.io/themes/AdminLTE/pages/UI/general.html" target="_blank">AdminLTE</a>  
* **Tool 3:** <a href="https://jgraph.github.io/mxgraph/" target="_blank">mxGraph</a>  


## Installation Guide
#### Prerequisites
* PHP: Version >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension + Database (MySQL, SQLite) + Web Server (Apache)
* Composer.

##### Step-by-Step

1. Clone the repository to your computer;

2. Inside the project's main folder, create a file named: **.env**; 

*(You can skip steps 2 and 3 by navigating to the folder in a terminal and using the command "copy .env.example .env")*

3. Copy the contents of the **.env.example** file to the newly created **.env** file;

4. Access the repository via a terminal and run the command: 
```composer install```

5. Still in the terminal, generate an application key with the command: 
```php artisan key:generate```

6. Configure the **.env** file with your local database settings;

**Example:**
```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. In the terminal, run the migrations with the command: **php artisan migrate --seed**;

*Note: The "--seed" flag is only for seeding the database. If you don't want the database pre-populated, remove this flag from the command.*

8. To run the project, use the command: **php artisan serve**;

10. Access the URL provided in the terminal.

#### Developed by [Lucas Piazzi](https://www.linkedin.com/in/lucas-piazzi/)

Any questions or business inquiries? Feel free to reach out to me at the link above.
