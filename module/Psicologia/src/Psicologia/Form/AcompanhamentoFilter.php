<?php
namespace Psicologia\Form;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Description of AcompanhamentoFilter
 *
 * @author
 */
class AcompanhamentoFilter implements InputFilterAwareInterface {

    protected $_inputFilter;

    public function getInputFilter() {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            /* criar filtros */
            $inputFilter->add($factory->createInput(array(
                'name' => 'matricula',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'motivo',
                'required' => true,
                'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'encaminhado',
                'required' => false,
                'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
                'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 255
						)
					)
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
