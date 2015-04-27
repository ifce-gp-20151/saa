<?php
namespace Application\Form;

use Core\Entity\DadosFamiliares;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class FamiliarFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('DadosFamiliares');

        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new DadosFamiliares());

        $this->add($this->_id());
        $this->add($this->_nome());
        $this->add($this->_idade());
        $this->add($this->_fl_mora());
        $this->add($this->_id_grau_parentesco($objectManager));
        $this->add($this->_id_profissao($objectManager));
    }

    protected function _id() {
        $e = array(
            'type'  => 'Zend\Form\Element\Number',
            'name'  => 'id',
            'options' => array(
                'label' => 'Cod.: ',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'readonly' => 'true',
                'id' => 'id',
            ),
        );
        return $e;
    }

    protected function _nome() {
        $e = array(
            'type'  => 'Zend\Form\Element\Text',
            'name'  => 'nome',
            'options' => array(
                'label' => 'Nome: ',
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control',
            ),
        );
        return $e;
    }

    protected function _idade() {
        $e = array(
            'type'  => 'Zend\Form\Element\Number',
            'name'  => 'idade',
            'options' => array(
                'label' => 'Idade: '
            ),
            'attributes' => array(
                'id' => 'idade',
                'class' => 'form-control',
            ),
        );
        return $e;
    }

    protected function _fl_mora() {
        $e = array(
            'type'  => 'Zend\Form\Element\Checkbox',
            'name'  => 'flMora',
            'options' => array(
                'label' => 'Mora com a pessoa? ',
            ),
            'attributes' => array(
                'id' => 'flMora',
            ),
        );
        return $e;
    }

    protected function _id_profissao(ObjectManager $objectManager) {
        $e = array(
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'name'  => 'idProfissao',
            'options' => array(
                'label' => 'Profissão:',
                'object_manager' => $objectManager,
                'empty_option'   => 'Selecione uma opção',
                'target_class' => 'Core\Entity\Profissao',
                'property' => 'descricao',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id'    => 'idProfissao',
                'hidden' => 'true',
            ),
        );
        return $e;
    }

    protected function _id_grau_parentesco(ObjectManager $objectManager) {
        $e = array(
            'type' => 'DoctrineORMModule\Form\Element\EntitySelect',
            'name'  => 'idGrauParentesco',
            'options' => array(
                'label' => 'Grau de Parentesco:',
                'empty_option'   => 'Selecione uma opção',
                'object_manager' => $objectManager,
                'target_class' => 'Core\Entity\GrauParentesco',
                'property' => 'descricao',
            ),
            'attributes' => array(
                'id'    => 'idGrauParentesco',
                'class' => 'form-control',
            ),
        );
        return $e;
    }

    public function getInputFilterSpecification() {
        return array(
            'id' => array(
                'required' => false,
            ),
            'nome' => array(
                'required' => true,
            ),
            'idade' => array(
                'required' => true,
            ),
            'idGrauParentesco' => array(
                'required' => true,
            ),
            'idProfissao' => array(
                'required' => true,
            ),
        );
    }

}
