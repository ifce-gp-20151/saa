<?php

namespace Psicologia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Core\Entity\Agenda;

class AgendamentoController extends AbstractActionController {

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
        $session = $this->getServiceLocator()->get('Session');
        $user = $session->offsetGet('user');
        return new ViewModel(array(
            'list' => $this->getEntityManager()
                ->getRepository('Core\Entity\Agenda')
                ->listar(),
        ));
    }



}
