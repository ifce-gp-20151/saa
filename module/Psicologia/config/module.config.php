<?php

namespace Psicologia;

return array(
    'router' => array(
        'routes' => array(
            'acompanhamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/acompanhamento[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Psicologia\Controller\Acompanhamento',
                        'action'     => 'index',
                        'module'     => 'psicologia',
                    ),
                ),
            ),
            'psicologia' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/psicologia',
                    'defaults' => array(
                        'controller'    => 'Index',
                        'action'        => 'index',
                        '__NAMESPACE__' => 'Psicologia\Controller',
                        'module'        => 'psicologia'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                        'child_routes' => array( //permite mandar dados pela url
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Psicologia\Controller\Index' => 'Psicologia\Controller\IndexController',
            'Psicologia\Controller\Acompanhamento' => 'Psicologia\Controller\AcompanhamentoController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_map' => include __DIR__  .'/../template_map.php',
    ),
);
