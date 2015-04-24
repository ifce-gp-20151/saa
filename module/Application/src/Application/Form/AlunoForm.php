<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de FamiliarForm
 *
 * @author
 */
class AlunoForm extends Form {

    public function __construct() {
        parent::__construct('aluno');
        $this->setAttribute('method', 'post');

        $this->add($this->_matricula());
        $this->add($this->_id_curso());
        $this->add($this->_situacao_escolar());
        $this->add($this->_id_pessoa());
        $this->add($this->_submit());
    }

    protected function _submit() {
        $e = new Element\Submit('submit');
        $e->setValue("Salvar");
        $e->setAttribute("class", "btn btn-primary");

        return $e;
    }

    protected function _matricula() {
        $e = new Element\Number('matricula');
        $e->setLabel('* Matrícula:');
        $e->setAttribute('id', 'matricula');
        $e->setAttribute('class', 'form-control numeric');
        $e->setAttribute('autofocus', 'autofocus');

        return $e;
    }

    protected function _id_curso() {
        $e = new Element\Hidden('id_curso');
        $e->setLabel('* Curso:');
        $e->setAttribute('id', 'id_curso');
        $e->setAttribute('class', 'form-control');

        return $e;
    }

    protected function _situacao_escolar() {
        $e = new Element\Textarea('situacao_escolar');
        $e->setLabel('Situação Escolar:');
        $e->setAttribute('id', 'situacao_escolar');
        $e->setAttribute('rows', 6);
        $e->setAttribute('class', 'form-control');

        return $e;
    }

    protected function _id_pessoa() {
        $e = new Element\Number('id_pessoa');
        $e->setLabel('* Pessoa:');
        $e->setAttribute('id', 'id_pessoa');
        $e->setAttribute('class', 'form-control');

        return $e;
    }
}
