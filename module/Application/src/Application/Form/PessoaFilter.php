<?php
namespace Application\Form;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Description of PessoaFilter
 *
 * @author
 */
abstract class PessoaFilter implements InputFilterAwareInterface {
    
    protected $_inputFilter;

    public function getInputFilter() {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            /* criar filtros */
            $this->_inputFilter->add($factory->createInput(array(
				'name' => 'nome',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 3,
							'max' => 255
						)
					)
				),
            )));

            $this->_inputFilter->add($factory->createInput(array(
                'name' => 'cpf',
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                ),
                'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'max' => 11
						),
					),
				),
            )));

            $this->_inputFilter->add($factory->createInput(array(
                'name' => 'rg',
                'required' => true,
                'filters' => array(
                    array('name' => 'Digits'),
                ),
                'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'max' => 20
						),
					),
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
