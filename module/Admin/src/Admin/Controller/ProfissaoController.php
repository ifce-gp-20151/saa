<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;

class ProfissaoController extends ActionController {

    /**
     * @var DoctrineORMEntityManager
     */
    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction() {
        return new ViewModel(array(
            'list' => $this->getEntityManager()->getRepository('Core\Entity\Profissao')->findAll(),
        ));
    }
}
