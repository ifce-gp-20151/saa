<?php
namespace Psicologia\Form;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Description of AgendamentoFilter
 *
 * @author
 */
class AgendamentoFilter implements InputFilterAwareInterface {

    protected $_inputFilter;

    public function getInputFilter() {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            /* criar filtros */
            $inputFilter->add($factory->createInput(array(
                'name' => 'data',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'hora_inicio',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'hora_fim',
                'required' => true,
            )));

            $this->_inputFilter = $inputFilter;
        }
        return $this->_inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Method not necessary.");
    }
}
