<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\ServidorForm;

class ServidorController extends AbstractActionController {

    /**
     * @var DoctrineORMEntityManager
     */
    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction() {
    }

    public function criarAction() {
        $form = new ServidorForm();

        $list_cargo = $this->getEntityManager()->getRepository('Core\Entity\Cargo')->listarTodos();
        $options_cargo = array();
        foreach ($list_cargo as $cargo) {
            $options_cargo[$cargo->getId()] = $cargo->getDescricao();
        }
        $form->get('id_cargo')->setValueOptions($options_cargo);

        $list_estado_civil = $this->getEntityManager()->getRepository('Core\Entity\EstadoCivil')->listarTodos();
        $options_estado_civil = array();
        foreach ($list_estado_civil as $estado_civil) {
            $options_estado_civil[$estado_civil->getId()] = $estado_civil->getDescricao();
        }
        $form->get('id_estado_civil')->setValueOptions($options_estado_civil);

        $request = $this->getRequest();
        if ($request->isPost()) {
            // validar e salvar
        }

        $viewModel = new ViewModel(array(
            'form' => $form,
            'title' => 'Criar Servidor'
        ));
        $viewModel->setTemplate('admin/servidor/salvar.phtml');

        return $viewModel;
    }
}
