CodeiStrap 
===========

Blog Base CodeIgniter Bootstrap
-------------------------------

A ideia a ter uma base para criar um blog (ou qualquer outro site) que já tenham algumas funcionalidades como:

## Funcionalidades

* CodeIgniter 2.*
* Twitter Bootstrap 3
* Autenticação
* Back-end
	* Gerenciamento dos usuário
	* Criar e gerenciar um post
	* Gerenciar comentários 
    * DataTables dinâmico
* Front-end
	* Usuário
		* Registro
		* Login
		* Esqueci a senha
		* Editar Perfil
	* Funcionalidade simples de um blog
* Log de Acesso

## Instalação
### Passo 1
#### Opção 1: Git Clone

	git clone git://github.com/marcelod/codeistrap novo_site

#### Opção 2: Baixar o repositório

    https://github.com/marcelod/codeistrap/archive/master.zip

### Passo 2

Configurar o arquivo application/database.php

	$db['default']['username'] = 'user'; // colocar usuário do banco de dados
	$db['default']['password'] = 'senha'; // senha para acesso ao banco de dados
	$db['default']['database'] = 'database'; // nome da base de dados a ser usada

### Passo 3

Criar a base de dados no servidor com o nome que definiu em seu arquivo application/database.php

### Passo 4

Rodar as migrations que com isso irá criar as tabelas e dados que precisa inicialmente.

Supondo que você baixou e instalou em /var/www/novo_site

Você irá rodar no navegador

	http://localhost/novo_site/instalar

Com isso já deve ter criado as tabelas e dados em seu banco de dados

* agora já pode remover o arquivo caso queira

### Passo 5

No arquivo application/config.php definir o sess_use_database como TRUE para poder gravar as sessões no banco de dados

	$config['sess_use_database'] = TRUE;

E agora já pode acessar o site no navegador e visualizar

http://localhost/novo_site/

## Acesso
	
	* users/login e senha
		* admin > 1234
		* user > 1234

## Log de Acesso

A parte de log de acesso já esta ok.

O que é necessário fazer é criar a uma pasta chamada *access* dentro de application/logs e dar permissão de escrita para a pasta log