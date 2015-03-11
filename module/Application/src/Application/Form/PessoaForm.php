<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de PessoaForm
 *
 * @author
 */
abstract class PessoaForm extends Form {

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
        $e->setLabel('Id:');
        $e->setAttribute('readonly', 'readonly');

        return $e;
    }

    protected function _nome() {
        $e = new Element\Text('nome');
        $e->setLabel('* Nome:');
        $e->setAttribute('id', 'nome');
        $e->setAttribute('class', 'form-control');

        return $e;
    }

    protected function _cpf() {
        $e = new Element\Text('cpf');
        $e->setLabel('* CPF:');
        $e->setAttribute('id', 'cpf');
        $e->setAttribute('class', 'form-control');

        return $e;
    }

    protected function _rg() {
        $e = new Element\Text('rg');
        $e->setLabel('RG:');
        $e->setAttribute('id', 'rg');
        $e->setAttribute('class', 'form-control');

        return $e;
    }

    protected function _sexo() {
        $e = new Element\Select('sexo');
        $e->setLabel('Sexo:');
        $e->setAttribute('id', 'sexo');
        $e->setAttribute('class', 'form-control');

        $options = array(
            'N' => 'Não Informado',
            'M' => 'Masculino',
            'F' => 'Feminino',
        );
        $e->setValueOptions($options);

        return $e;
    }

    protected function _dt_nascimento() {
        $e = new Element\Text('dt_nascimento');
        $e->setAttribute('id', 'dt_nascimento');
        $e->setLabel('* Data de Nascimento:');
        $e->setAttribute('class', 'form-control date');

        return $e;
    }

    protected function _id_estado_civil() {
        $e = new Element\Select('id_estado_civil');
        $e->setLabel('* Estado Civil:');
        $e->setAttribute('id', 'id_estado_civil');
        $e->setAttribute('class', 'form-control');

        return $e;
    }
}
