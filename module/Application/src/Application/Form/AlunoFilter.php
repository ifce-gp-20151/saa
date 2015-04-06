<?php
namespace Application\Form;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Description of AlunoFilter
 *
 * @author
 */
class AlunoFilter implements InputFilterAwareInterface {

    protected $_inputFilter;

    public function getInputFilter() {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            /* criar filtros */
            $inputFilter->add($factory->createInput(array(
                'name' => 'matricula',
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'id_curso',
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'cpf',
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                ),
            )));
			
            $inputFilter->add($factory->createInput(array(
                'name' => 'situacao_escolar',
                'filters' => array(
                  array('name' => 'StripTags'),
                  array('name' => 'StringTrim'),
        			),
            )));
			
            $this->_inputFilter = $inputFilter;
        }
        return $this->_inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Method not necessary.");
    }
}
