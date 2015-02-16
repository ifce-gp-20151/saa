<?php

namespace Psicologia\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de AcompanhamentoIndividualForm
 *
 * @author
 */
class AcompanhamentoIndividualForm extends Form {

    public function __construct() {
        parent::__construct('acompanhamento_individual');
        $this->setAttribute('method', 'post');

        $this->add($this->_id());
        $this->add($this->_numero_encontro());
        $this->add($this->_descricao());
        $this->add($this->_submit());
    }

    protected function _submit() {
        $e = new Element\Submit('submit');
        $e->setValue("Salvar");
        $e->setAttribute("class", "btn btn-primary");

        return $e;
    }

    protected function _id() {
        $e = new Element\Hidden('id');
        $e->setAttribute('id', 'id');

        return $e;
    }

    protected function _numero_encontro() {
        $e = new Element\Text('numero_encontro');
        $e->setLabel('* Número encontro:');
        $e->setAttribute('id', 'numero_encontro');
        $e->setAttribute('class', 'form-control numeric');

        return $e;
    }

    protected function _descricao() {
        $e = new Element\Textarea('descricao');
        $e->setLabel('* Descrição:');
        $e->setAttribute('id', 'descricao');
        $e->setAttribute('rows', 4);
        // $e->setAttrib('cols', 30);
        $e->setAttribute('class', 'form-control');

        return $e;
    }
}
