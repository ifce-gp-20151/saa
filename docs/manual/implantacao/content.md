# Introdução

Este documento visa mostrar como o sistema SAA deve ser instalado e configurado
para ambiente de produção.

# Sistema Operacional

Debian 7 wheezy ([Download](http://debian.c3sl.ufpr.br/debian-cd/))
ou Ubuntu Server 14.04 LTS ([Download](http://www.ubuntu.com/download/server))

**Obs.**: Todo o restante da documentação é baseada nestes sistema, pois ambos
utilizam a mesma tecnologia para instalação de pacotes.

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

Das dependências descritas em `composer.json`, são necessárias:

* zendframework/zendframework
* doctrine/doctrine-orm-module
* dino/dompdf-module

Subir para o servidor somente o necessário para o funcionamento.

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

## Scripts de ACL

_Em desenvolvimento..._

## Merge de release anterior

_Em desenvolvimento..._
