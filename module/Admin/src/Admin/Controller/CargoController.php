<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\CargoForm;
use Admin\Form\CargoFilter;
use Core\Entity\Cargo;

class CargoController extends ActionController {

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
        $pagina = $this->params()->fromQuery('pagina', 1);
		$paginacao = $this->getServiceLocator()->get('Core\Controller\Paginacao');
		$offset = $paginacao->getOffset($pagina);

		$restricao = $this->params()->fromQuery('restricao', null);
        
    
        return new ViewModel(array(
            'list' => $this->getEntityManager()->getRepository('Core\Entity\Cargo')->listar($restricao, $offset),
            'pagina' => $pagina,
			'restricao' => $restricao,
        ));
    }
    
    public function criarAction() {
        $form = new CargoForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $obj = new Cargo();
            $filter = new CargoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $obj->exchangeArray($form->getData());
                try {
                    $this->getEntityManager()->persist($obj);
                    $this->getEntityManager()->flush();
                    $this->messages()->flashSuccess('Cargo criado com sucesso.');
                    return $this->redirect()->toRoute('cargo');
                } catch (\Exception $e) {
                    if (preg_match('/23505/', $e->getMessage())) {
                        $this->messages()->flashWarning('Cargo já existe.');
                    } else {
                        $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                    }
                }
            }
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form
		));
		$viewModel->setVariable('title', 'Criar Cargo');
		$viewModel->setTemplate('admin/cargo/salvar.phtml');

		return $viewModel;
    }
    
    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->messages()->flashWarning('Cargo não informado.');
            return $this->redirect()->toRoute('cargo', array('action' => 'criar'));
        }
        
        $obj = $this->getEntityManager()->find('Core\Entity\Cargo', $id);
        if (! $obj) {
            $this->messages()->flashWarning('Cargo não encontrado.');
            return $this->redirect()->toRoute('cargo', array('action' => 'criar'));
        }
        
        $form  = new CargoForm();
        $form->bind($obj);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $filter = new CargoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                try {
                    $this->getEntityManager()->flush();
                    $this->messages()->flashSuccess('Cargo atualizado com sucesso.');
                    return $this->redirect()->toRoute('cargo');
                } catch (\Exception $e) {
                    if (preg_match('/23505/', $e->getMessage())) {
                        $this->messages()->flashWarning('Cargo já existe.');
                    } else {
                        $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                    }
                }
            }
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form
		));
		$viewModel->setVariable('title', 'Editar Cargo');
		$viewModel->setTemplate('admin/cargo/salvar.phtml');

		return $viewModel;
    }
    
    public function deletarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $obj = $this->getEntityManager()->find('Core\Entity\Cargo', $id);
            if ($obj) {
                $this->getEntityManager()->remove($obj);
                $this->getEntityManager()->flush();
                $this->messages()->flashSuccess('Cargo deletado com sucesso.');
            } else {
                $this->messages()->flashWarning('Cargo não encontrada.');
            }
        } catch (\Exception $e) {
            if (preg_match('/23503/', $e->getMessage())) {
                $this->messages()->flashWarning('Cargo é referenciada e não pode ser deletada.');
            } else {
                $this->messages()->flashError('Ocorreu um erro ao deletar. Detalhes: ' . $e->getMessage());
            }
        }
        $this->redirect()->toRoute('cargo');
    }
}
