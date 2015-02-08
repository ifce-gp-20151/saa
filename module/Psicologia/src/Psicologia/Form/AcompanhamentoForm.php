<?php

namespace Psicologia\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de AcompanhamentoForm
 *
 * @author
 */
class AcompanhamentoForm extends Form {

    public function __construct() {
        parent::__construct('acompanhamento');
        $this->setAttribute('method', 'post');

        $this->add($this->_id());
        $this->add($this->_matricula());
        $this->add($this->_motivo());
        $this->add($this->_encaminhado());
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
        $e->setAttribute('id', 'id');
        $e->setAttribute('class', 'form-control');
        $e->setLabel('Cód.:');
        $e->setAttribute('readonly', 'readonly');

        return $e;
    }

    protected function _matricula() {
        $e = new Element\Text('matricula');
        $e->setLabel('Matrícula:');
        $e->setAttribute('id', 'matricula');
        $e->setAttribute('class', 'form-control numeric');
        $e->setAttribute('autofocus', 'autofocus');

        return $e;
    }

    protected function _motivo() {
        $e = new Element\Textarea('motivo');
        $e->setLabel('* Motivo:');
        $e->setAttribute('id', 'motivo');
        $e->setAttribute('rows', 6);
        // $e->setAttrib('cols', 30);
        $e->setAttribute('class', 'form-control');

        return $e;
    }

    protected function _encaminhado() {
        $e = new Element\Text('encaminhado');
        $e->setLabel('Encaminhado por:');
        $e->setAttribute('id', 'encaminhado');
        $e->setAttribute('class', 'form-control');

        return $e;
    }
}
