<?php

namespace Application\Form;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Description of FamiliarFilter
 *
 * @author
 */

class FamiliarFilter implements InputFilterAwareInterface {

    protected $_inputFilter;

    public function getInputFilter() {
        if( !$this->_inputFilter ) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();



            $inputFilter->add($factory->createInput(array(
                'name' => 'nome',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'idade',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'flMora',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'idProfissao',
                'required' => false,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'idGrauParentesco',
                'required' => false,
            )));

            $this->_inputFilter = $inputFilter;
        }
        return $this->_inputFilter;
    }


    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Method not necessary.");
    }

}
