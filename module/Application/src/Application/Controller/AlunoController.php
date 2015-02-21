<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Core\Controller\ActionController;

class AlunoController extends ActionController {

    /*
     * @var Doctrine ORMEntityManager
     */
     protected $em;

     private function getEntityManager() {

        if( null === $this->em ) {
            $this->em = $this->getServiceLocator()
            ->get('doctrine.entitymanager.orm_default');

        }
        return $this->em;
     }

     public function indexAction() {
       $session = $this->getServiceLocator()->get('Session');
       $user = $session->offsetGet('user');
       return new ViewModel(array(
           'list' =>

              $this->getEntityManager()
               ->getRepository('Core\Entity\Aluno')
               ->findAll(),
       ));
    }
}
