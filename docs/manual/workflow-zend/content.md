# Definir Autorização (ACL)

No arquivo `./docs/db/dml.acl.sql` adicione os `INSERT`'s necessários.

Exemplo para um _Controller_ `Professor` no módulo `Application`, com a _action_ `index`,
em que apenas o `admin` tem acesso.

Neste arquivo temos as _Roles_ ou Papeis, indicando qual o tipo de usuário.
Algumas _roles_ já foram definidas, como a `admin`.

Temos também os _Modules_. O módulo que a gente quer também já existe `Application`.

Em seguida temos os `Controllers`. Esse vamos precisar criar. Para isso basta adicionar uma
linha, colocando o id como incremento do anterior e o nome do controller:

~~~
INSERT INTO saa.acl_controllers(id, controller) VALUES ( 9, 'Professor');
~~~

Abaixo temos as _Actions_. A action `index` também já existe.

Em seguida temos os _Resources_ ou Recursos, indicando o trio _Module_,
_Controller_, _Action_. Crie a linha:

~~~
INSERT INTO saa.acl_resources(id, module_id, controller_id, action_id)
VALUES (28, 1, 9, 1);--application/professor/index
~~~

Por fim temos os _Privileges_ ou Privilégios, indicando que _Role_ tem acesso
a que _Resource_. Crie no local indicado pelos comentários:

~~~
-- 
-- admin
-- 
INSERT INTO saa.acl_privileges(resource_id, role_id, allow)
VALUES ( 28, 3, true);--application/professor/index
~~~

Execute as queries no banco de dados.

# Crie uma rota

As rotas são definidas no arquivo `./module/Application/config/module.config.php`.
Existe um arquivo desses para cada módulo. Encontre o trecho:

~~~
'router' => array(
	'routes' => array(
    	/* código existente ... */
    ),
),
~~~

Adicione a linha:

~~~
'professor' => array(
	'type' => 'Segment',
	'options' => array(
		'route'    => '/professor',
		'defaults' => array(
			'controller' => 'Application\Controller\Professor',
            'action'     => 'index',
            'module'     => 'application',
		),
	),
),
~~~

# Mapeie o Controller

Os controllers são mepeados nesse mesmo arquivo. Encontre o trecho:

~~~
'controllers' => array(
        'invokables' => array(
            /* código existente ... */
        ),
    ),
~~~

Adicione a linha:

~~~
'Application\Controller\Professor' => 'Application\Controller\ProfessorController',
~~~

# Criar o Controller

Crie o arquivo `ProfessorController` dentro de `./module/Application/src/Application/Controller/`.

Com o conteúdo:

~~~
<?php

namespace  Application\Controller;

use Zend\View\Model\ViewModel;
use Core\Controller\ActionController;

class ProfessorController extends ActionController {

	/**
	 * @var DoctrineORMEntityManager
	 */
	protected $em;
    
    private function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()
            	->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}
    
    public function indexAction() {
    	return new ViewModel(array());
    }
}
~~~

# Criar View

Crie o arquivo `index.phtml` dentro de

`./module/Application/view/application/professor/`.

Com o conteúdo:

~~~
<h3>você está em application/professor/index</h3>
~~~

# Acessar Action

Faça login com usuário da _role_ `admin`, digite no final da URL: `/professor`.








