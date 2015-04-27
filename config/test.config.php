<?php

return array(
    'modules' => array(
        'Application',
        'Core',
        'ZealMessages',
        'Coreproc',
    ),
    'db' => array(
        'driver' => 'PDO',
        'dsn' => 'pgsql:host=localhost;dbname=saa_test',
        'username' => 'postgres',
        'password' => 'f1d1@s',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php'
        ),
        'module_paths' => array(
            './module',
            './vendor'
        )
    )
);
