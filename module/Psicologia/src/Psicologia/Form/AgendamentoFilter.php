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
                'name' => 'horaInicio',
                'required' => true,
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'horaFim',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Callback',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Callback::INVALID_VALUE => 'A hora de fim deve ser maior que a hora de início!',
                            ),
                            'callback' => function($value, $context=array()) {
                                // value of this input
                                $hr_fim = $value;
                                // value of input to check against from context
                                $hr_ini = $context['horaInicio'];
                                // compare times, eg..
                                $isValid = $hr_ini < $hr_fim;
                                return $isValid;
                            },
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
