Fazer checkout.

Enter the project directory: `cd project-name`

Install zend: `php composer.phar install`

Create file `local.php` at `config/autoload`

Put the content:

~~~
<?php

return array(
    'db' => array(
        'username' => 'postgres',
        'password' => '**secret**',
    )
);
~~~

Run ACL inserts.

* /docs/db/ddl.acl.sql
* /docs/db/dml.acl.sql

Install mcrypt for hash operations: `sudo apt-get install php5-mcrypt`

Install intl for i18n: `sudo apt-get install php5-intl`

### Apache 2 (2.2.22-1ubuntu1.7)

Create file `project-name` at `/etc/apache2/sites-enabled` with the following content:

~~~
<VirtualHost *:80>
	ServerName saa.local
	DocumentRoot /path/to/saa/public

	<Directory /path/to/saa/public>
		DirectoryIndex index.php
		AllowOverride All
		Order allow,deny
		Allow from all
	</Directory>
</VirtualHost>
~~~

### Apache 2 (2.4.7-1ubuntu4.1)

Create file `project-name.conf` at `/etc/apache2/sites-enabled` with the following content:

~~~
<VirtualHost *:80>
    ServerName saa.local

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

Restart apache2: `sudo service apache2 restart`

Create a virtual host name, edit `/etc/hosts`, and add the line to the end:

`127.0.1.1       saa.local`

Ok, you're good to go.

## Traps

<http://stackoverflow.com/questions/26377753/zend-authentication-storage-session-session-validation-failed-any-ideas>
