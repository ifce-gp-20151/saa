# Introdução

Este documento visa mostrar como o sistema SAA deve ser instalado e configurado
para ambiente de produção.

# Sistema Operacional

Debian 7 wheezy ([Download](http://debian.c3sl.ufpr.br/debian-cd/))
ou Ubuntu Server 14.04 LTS ([Download](http://www.ubuntu.com/download/server))

**Obs.**: Todo o restante da documentação é baseada nestes sistema, pois ambos
utilizam a mesma tecnologia para instalação de pacotes.

# Ambiente de execução

O projeto necessita do `php` para a sua execução. É necessário instalar a versão
**\>=5.3**, devido ao Zend 2 fazer utilização de _namespaces_, _late static binding_,
funções _lambda_, _closures_.

Mais detalhes em: <http://framework.zend.com/manual/current/en/ref/overview.html>

A instalação pode ser feita da seguinte maneira:

~~~
sudo apt-get install php5
~~~

Verifique a versão: `php -v`.

Para algumas operações com _hash_, é necessário a instalação do `php5-mcrypt`:

~~~
sudo apt-get install php5-mcrypt
~~~

Para a internacionalização (i18n) do projeto é necessário o pacote `php5-intl`:

~~~
sudo apt-get install php5-intl
~~~

# Servidor

Para servir o sistema podemos utilizar [Apache2](http://httpd.apache.org/) ou
[Nginx](http://nginx.org/), sendo que este último é o mais indicado.

## Instalação Apache2

~~~
sudo apt-get install apache2
~~~

### Configuração Apache2 (2.4 ou superior)

Crie o arquivo saa.conf dentro de `/etc/apache2/sites-available` com o seguinte conteúdo:

~~~
<VirtualHost *:80>
    ServerName saa.ifce.edu.br

    DocumentRoot /path/to/saa/public

    <Directory /path/to/saa/public/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog /var/log/apache2/error.log
    CustomLog /var/log/apache2/access.log combined
</VirtualHost>
~~~

Modifique o caminho do projeto para o local adequado.

Recarregue as configurações com: `sudo service apache2 reload`.

## Instalação Nginx

~~~
sudo apt-get install nginx
~~~

### Configuração Nginx

_Em desenvolvimento..._

# Banco de dados

O SAA utiliza [PostgreSQL](http://www.postgresql.org/) como banco de dados relacional.

Última versão estável: `9.4`.

## Debian

<http://www.postgresql.org/download/linux/debian/>

Crie o arquivo `/etc/apt/sources.list.d/pgdg.list`, adicione a linha para o repositório:

~~~
deb http://apt.postgresql.org/pub/repos/apt/ wheezy-pgdg main
~~~

Importe a chave assinada do repositório, e atualize a lista de pacotes

~~~
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | \
  sudo apt-key add -
sudo apt-get update
apt-get install postgresql-9.4
~~~

## Ubuntu

<http://www.postgresql.org/download/linux/ubuntu/>

Crie o arquivo `/etc/apt/sources.list.d/pgdg.list`, adicione a linha para o repositório:

~~~
deb http://apt.postgresql.org/pub/repos/apt/ trusty-pgdg main
~~~

Importe a chave assinada do repositório, e atualize a lista de pacotes

~~~
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | \
  sudo apt-key add -
sudo apt-get update
apt-get install postgresql-9.4
~~~

# Obtendo código-fonte

O projeto está disponível em <https://github.com/ifce-gp-20151/saa>.

Para a instalação em ambiente de produção é necessário baixar um _release_ estável e testado.
Os _releases_ podem ser baixados em <https://github.com/ifce-gp-20151/saa/releases>.

## Instalando dependências

Das dependências descritas em `composer.json`, são necessárias para a produção:

* zendframework/zendframework
* doctrine/doctrine-orm-module
* dino/dompdf-module

Envie para o servidor somente o necessário para o funcionamento.

Em `config/application.config.php` comentar as linhas referentes aos `modules`:

* ZFTool
* ZendDeveloperTools

## Configuração da conexão com banco de dados

Em `config/autoload/global.php`, modificar trecho:

~~~
'db' => array(
	'driver' => 'Pdo',
	'dsn' => 'pgsql:host=localhost;dbname=saa_production',
),
~~~

Em seguida criar arquivo `config/autoload/local.php`, colocando os dados:

~~~
'db' => array(
    'username' => 'postgres',
	'password' => 'secret',
),
~~~

## Script de criação do banco de dados

Após criar o banco de dados `saa_production` é necessário executar o script
`docs/db/ddl.sql`, que contém a definição das tabelas, relacionamentos, etc.

## Script de ACL

Executar o arquivo `docs/db/dml.acl.sql` que contém as regras de Autorização do sistema.

## Merge de release anterior

_Em desenvolvimento..._
