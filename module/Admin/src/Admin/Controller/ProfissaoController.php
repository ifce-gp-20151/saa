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
        return new ViewModel(array(
            'list' => $this->getEntityManager()->getRepository('Core\Entity\Profissao')->findAll(),
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
            'form'=>$form
		));
		$viewModel->setVariable('title', 'Criar Profissão');
		$viewModel->setTemplate('admin/profissao/salvar.phtml');

		return $viewModel;
    }
}
