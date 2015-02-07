<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\ProfissaoForm;
use Admin\Form\ProfissaoFilter;
use Core\Entity\Profissao;

class ProfissaoController extends ActionController {

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
            'list' => $this->getEntityManager()->getRepository('Core\Entity\Profissao')->listar($restricao, $offset),
            'pagina' => $pagina,
			'restricao' => $restricao,
        ));
    }
    
    public function criarAction() {
        $form = new ProfissaoForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $obj = new Profissao();
            $filter = new ProfissaoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $obj->exchangeArray($form->getData());
                try {
                    $this->getEntityManager()->persist($obj);
                    $this->getEntityManager()->flush();
                    $this->messages()->flashSuccess('Profissão criada com sucesso.');
                    return $this->redirect()->toRoute('profissao');
                } catch (\Exception $e) {
                    if (preg_match('/23505/', $e->getMessage())) {
                        $this->messages()->flashWarning('Profissão já existe.');
                    } else {
                        $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                    }
                }
            }
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form
		));
		$viewModel->setVariable('title', 'Criar Profissão');
		$viewModel->setTemplate('admin/profissao/salvar.phtml');

		return $viewModel;
    }
    
    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->messages()->flashWarning('Profissão não informada.');
            return $this->redirect()->toRoute('profissao', array('action' => 'criar'));
        }
        
        $obj = $this->getEntityManager()->find('Core\Entity\Profissao', $id);
        if (! $obj) {
            $this->messages()->flashWarning('Profissão não encontrada.');
            return $this->redirect()->toRoute('profissao', array('action' => 'criar'));
        }
        
        $form  = new ProfissaoForm();
        $form->bind($obj);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $filter = new ProfissaoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                try {
                    $this->getEntityManager()->flush();
                    $this->messages()->flashSuccess('Profissão atualizada com sucesso.');
                    return $this->redirect()->toRoute('profissao');
                } catch (\Exception $e) {
                    if (preg_match('/23505/', $e->getMessage())) {
                        $this->messages()->flashWarning('Profissão já existe.');
                    } else {
                        $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                    }
                }
            }
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form
		));
		$viewModel->setVariable('title', 'Editar Profissão');
		$viewModel->setTemplate('admin/profissao/salvar.phtml');

		return $viewModel;
    }
    
    public function deletarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $obj = $this->getEntityManager()->find('Core\Entity\Profissao', $id);
            if ($obj) {
                $this->getEntityManager()->remove($obj);
                $this->getEntityManager()->flush();
                $this->messages()->flashSuccess('Profissão deletada com sucesso.');
            } else {
                $this->messages()->flashWarning('Profissão não encontrada.');
            }
        } catch (\Exception $e) {
            if (preg_match('/23503/', $e->getMessage())) {
                $this->messages()->flashWarning('Profissão é referenciada e não pode ser deletada.');
            } else {
                $this->messages()->flashError('Ocorreu um erro ao deletar. Detalhes: ' . $e->getMessage());
            }
        }
        $this->redirect()->toRoute('profissao');
    }
}
