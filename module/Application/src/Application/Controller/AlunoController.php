<?php

namespace Application\Controller;
use Zend\View\Model\ViewModel;
use Core\Controller\ActionController;
use Zend\View\Model\JsonModel;
use Application\Form\AlunoForm;
use Application\Form\AlunoFilter;
use Core\Entity\Aluno;

class AlunoController extends ActionController {

    /*
     * @var Doctrine ORMEntityManager
     */
    protected $em;

    private function getEntityManager() {
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

        $session = $this->getServiceLocator()->get('Session');
        $user = $session->offsetGet('user');
        return new ViewModel(array(
            'list' => $this->getEntityManager()->getRepository('Core\Entity\Aluno')->listar($restricao, $offset),
            'pagina' => $pagina,
            'restricao' => $restricao,
        ));
    }

    public function ajaxBuscarCursoAction() {
        $params = array();
        $term = $this->params()->fromQuery('term');
        try {
            $curso = $this->getEntityManager()->getRepository('Core\Entity\Curso')->ajaxBuscarCurso($term);
            if ($curso) {
                $params['rows'] = $curso;
            } else {
                $params['error'] = sprintf('Curso %s não encontrado.', $term);
            }
        }
        catch(\Exception $e) {
            $params['error'] = 'Ocorreu um erro ao buscar. Detalhes: ' . $e->getTraceAsString();
        }
        return new JsonModel($params);
    }

    public function criarAction() {
        $form = new AlunoForm();
        $params = array('form' => $form,);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $obj = new Aluno();
            $filter = new AlunoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $obj->exchangeArray($data);
                $obj->setMatricula($aluno);
                try {
                    $this->getEntityManager()->persist($obj);
                    $this->getEntityManager()->flush();
                    $this->messages()->flashSuccess('Aluno criado com sucesso.');
                    return $this->redirect()->toRoute('aluno');
                }
                catch(\Exception $e) {
                    $this->messages()->error('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                }
            }
        }

        $viewModel = new ViewModel($params);
        $viewModel->setVariable('title', 'Novo Aluno');
        $viewModel->setTemplate('application/aluno/salvar.phtml');
        return $viewModel;
    }
}
