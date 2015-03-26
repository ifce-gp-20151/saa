<?php

namespace Psicologia\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de AgendamentoForm
 *
 * @author
 */
class AgendamentoForm extends Form {

    public function __construct() {
        parent::__construct('agendamento');
        $this->setAttribute('method', 'post');

        $this->add($this->_id());
        $this->add($this->_data());
        $this->add($this->_hora_inicio());
        $this->add($this->_hora_fim());
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

    protected function _hora_inicio() {
        $e = new Element\Text('horaInicio');
        $e->setLabel('Hora Início:');
        $e->setAttribute('id', 'hora_inicio');
        $e->setAttribute('class', 'form-control time');

        return $e;
    }

    protected function _hora_fim() {
        $e = new Element\Text('horaFim');
        $e->setLabel('hora fim:');
        $e->setAttribute('id', 'hora_fim');
        $e->setAttribute('class', 'form-control time');

        return $e;
    }

    protected function _data() {
        $e = new Element\Text('data');
        $e->setLabel('data:');
        $e->setAttribute('id', 'data');
        $e->setAttribute('class', 'form-control date');

        return $e;
    }
}
