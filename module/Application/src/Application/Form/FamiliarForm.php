<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Descrição de FamiliarForm
 *
 * @author
 */

 class FamiliarForm extends Form {


     public function __construct(ObjectManager $objectManager) {
         parent::__construct('familiar');

         $hydrator = new DoctrineHydrator($objectManager);
         
         $this->setHydrator($hydrator);
         $familiarFieldset = new FamiliarFieldset($objectManager);
         $familiarFieldset->setUseAsBaseFieldset(true);
         $this->add($familiarFieldset);

         $this->setAttribute('method', 'post');
         $this->add($this->_submit());
     }

     protected function _submit() {
         $e = new Element\Submit('submit');
         $e->setValue("Salvar");
         $e->setAttribute("class", "btn btn-primary");

         return $e;
     }

 }
