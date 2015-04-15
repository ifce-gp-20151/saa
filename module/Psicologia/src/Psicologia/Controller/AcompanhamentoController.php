<?php

namespace Psicologia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Psicologia\Form\AcompanhamentoForm;
use Psicologia\Form\AcompanhamentoFilter;
use Core\Entity\Acompanhamento;

class AcompanhamentoController extends AbstractActionController {

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
        $session = $this->getServiceLocator()->get('Session');
        $user = $session->offsetGet('user');
        return new ViewModel(array(
            'list' => $this->getEntityManager()
                ->getRepository('Core\Entity\Acompanhamento')
                ->listarPorPsicologo($user->id),
        ));
    }

    public function criarAction() {
        $form = new AcompanhamentoForm();
        $params = array(
            'form' => $form,
        );

        $request = $this->getRequest();
        if ($request->isPost()) {
            $obj = new Acompanhamento();
            $filter = new AcompanhamentoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();

                // validar matricula
                $aluno = $this->getEntityManager()->getRepository('Core\Entity\Aluno')
                    ->findOneBy(array('matricula' => $data['matricula']));
                if (! $aluno) {
                    $this->messages()->flashWarning(sprintf('Aluno com matrícula %d não encontrado.', $data['matricula']));
                    return $this->redirect()->toRoute('acompanhamento');
                }

                $session = $this->getServiceLocator()->get('Session');
				        $user = $session->offsetGet('user');
                $servidor = $this->getEntityManager()->getRepository('Core\Entity\Servidor')
                    ->findOneBy(array('id' => $user->id));

                $obj->exchangeArray($data);
                $obj->setMatricula($aluno);
                $obj->setIdServidor($servidor);
                try {
                    $this->getEntityManager()->persist($obj);
                    $this->getEntityManager()->flush();
                    $this->messages()->flashSuccess('Acompanhamento criado com sucesso.');
                    return $this->redirect()->toRoute('acompanhamento');
                } catch (\Exception $e) {
                    $this->messages()->error('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                }
            }
        } else {
            $matricula = $this->params()->fromQuery('matricula');
            if (preg_match('/^\d+$/', $matricula)) {
                $form->get('matricula')->setValue($matricula);
            }
        }

        $viewModel = new ViewModel($params);
    	$viewModel->setVariable('title', 'Novo Acompanhamento');
    	$viewModel->setTemplate('psicologia/acompanhamento/salvar.phtml');

    	return $viewModel;
    }

    public function ajaxBuscarAlunoAction() {
        $params = array();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $matricula = $this->params()->fromPost('matricula');
            try {
                $aluno = $this->getEntityManager()->getRepository('Core\Entity\Aluno')
                    ->ajaxFindByMatricula($matricula);
                if ($aluno) {
                    $params['aluno'] = $aluno;
                    $params['ok'] = true;
                } else {
                    $params['error'] = sprintf('Aluno com matrícula %s não encontrado.', $matricula);
                }
            } catch (\Exception $e) {
                $params['error'] = 'Ocorreu um erro ao buscar. Detalhes: ' . $e->getTraceAsString();
            }
        } else {
            $params['error'] = 'Requisição não pode ser concluída.';
        }

        return new JsonModel($params);
    }

    public function detalhesAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->messages()->flashWarning('Acompanhamento não informado.');
            return $this->redirect()->toRoute('acompanhamento');
        }

        $obj = $this->getEntityManager()
            ->getRepository('Core\Entity\Acompanhamento')
            ->buscarPor($id);
        $enderecos = $this->getEntityManager()
            ->getRepository('Core\Entity\Endereco')
            ->listarPor($obj['id']);

        $familiares = $this->getEntityManager()
            ->getRepository('Core\Entity\DadosFamiliares')
            ->listarPor($obj['id']);

        $acompanhamentos = $this->getEntityManager()
            ->getRepository('Core\Entity\AcompanhamentoIndividual')
            ->listarPor($id);

        $agendamentos = $this->getEntityManager()
            ->getRepository('Core\Entity\Agenda')
            ->listarPorAcompanhamento($id);

        return new ViewModel(array(
            'obj' => $obj,
            'enderecos' => $enderecos,
            'familiares' => $familiares,
            'acompanhamentos' => $acompanhamentos,
            'agendamentos' => $agendamentos,
            'id' => $id,
        ));
    }

}
