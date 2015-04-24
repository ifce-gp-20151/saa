<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de FamiliarForm
 *
 * @author
 */

 class FamiliarForm extends Form {


     public function __construct() {
         parent::__construct('familiar');
         $this->setAttribute('method', 'post');

         $this->add($this->_id());
         $this->add($this->_nome());
         $this->add($this->_idade());
         $this->add($this->_fl_mora());
         $this->add($this->_id_grau_parentesco());
         $this->add($this->_id_profissao());

         $this->add($this->_submit());
     }

     protected function _submit() {
         $e = new Element\Submit('submit');
         $e->setValue("Salvar");
         $e->setAttribute("class", "btn btn-primary");

         return $e;
     }

     protected function _id() {
         $e = new Element\Text('id');
         $e->setLabel('Cod.: ');
         $e->setAttribute('id', 'id');
         $e->setAttribute('readonly', 'readonly');
         $e->setAttribute('class', 'form-control');

         return $e;
     }

     protected function _nome() {
         $e = new Element\Text('nome');
         $e->setLabel('Nome: ');
         $e->setAttribute('id', 'nome');
         $e->setAttribute('class', 'form-control');

         return $e;
     }

     protected function _idade() {
         $e = new Element\Number('idade');
         $e->setLabel('Idade: ');
         $e->setAttribute('id', 'idade');
         $e->setAttribute('class', 'form-control');

         return $e;
     }

     protected function _fl_mora() {
         $e = new Element\Checkbox('flMora');
         $e->setLabel('Mora com a pessoa?: ');
         $e->setAttribute('id', 'fl_mora');

         return $e;
     }

     protected function _id_profissao() {
         $e = new Element\Hidden('idProfissao');
         $e->setLabel('Profissão: ');
         $e->setAttribute('id', 'idProfissao');
         $e->setAttribute('class', 'form-control');

         return $e;
     }

     protected function _id_grau_parentesco() {
         $e = new Element\Hidden('idGrauParentesco');
         $e->setLabel('Grau de Parentesco: ');
         $e->setAttribute('id', 'idGrauParentesco');
         $e->setAttribute('class', 'form-control');

         return $e;
     }

 }
