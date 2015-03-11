<?php

namespace Admin\Form;

use Application\Form\PessoaForm;
use Zend\Form\Element;

/**
 * Descrição de ServidorForm
 *
 * @author
 */
class ServidorForm extends PessoaForm {

    public function __construct() {
        parent::__construct('servidor');
        $this->setAttribute('method', 'post');

        $this->add($this->_id());
        $this->add($this->_siape());
        $this->add($this->_id_cargo());

        $this->add($this->_nome());
        $this->add($this->_cpf());
        $this->add($this->_rg());
        $this->add($this->_sexo());
        $this->add($this->_dt_nascimento());
        $this->add($this->_id_estado_civil());

        $this->add($this->_submit());
    }

    protected function _siape() {
        $e = new Element\Text('siape');
        $e->setLabel('* Siape:');
        $e->setAttribute('id', 'siape');
        $e->setAttribute('class', 'form-control numeric');

        return $e;
    }

    protected function _id_cargo() {
        $e = new Element\Select('id_cargo');
        $e->setLabel('* Cargo:');
        $e->setAttribute('id', 'id_cargo');
        $e->setAttribute('class', 'form-control');

        return $e;
    }
}
