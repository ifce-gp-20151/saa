<?php
namespace Psicologia\Form;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

/**
 * Description of AcompanhamentoIndividualFilter
 *
 * @author
 */
class AcompanhamentoIndividualFilter implements InputFilterAwareInterface {
    protected $_inputFilter;

    public function getInputFilter() {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            /* criar filtros */

            $this->_inputFilter = $inputFilter;
        }
        return $this->_inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Method not necessary.");
    }
}
