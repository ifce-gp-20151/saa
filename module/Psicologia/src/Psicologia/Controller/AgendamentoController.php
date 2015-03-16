<?php

namespace Psicologia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Psicologia\Form\AgendamentoForm;
use Psicologia\Form\AgendamentoFilter;
use Core\Entity\Agenda;

class AgendamentoController extends AbstractActionController {

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
            'list' => $this->getEntityManager()
                ->getRepository('Core\Entity\Agenda')
                ->listar(),
        ));
    }


    public function criarAction() {
        $form = new AgendamentoForm();
        $params = array(
            'form' => $form,
        );

        $request = $this->getRequest();
        if ($request->isPost()) {
            $obj = new Agenda();
            $filter = new AgendamentoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());
            $id_acompanhamento = $this->params()->fromRoute('id_acompanhamento');
            if ($form->isValid()) {
                $data = $form->getData();
                $obj->exchangeArray($data);

                try {
                    $session = $this->getServiceLocator()->get('Session');
                    $user = $session->offsetGet('user');
                    $horario_disponivel = $this->getEntityManager()->getRepository('Core\Entity\Agenda')->isHorarioDisponivel($obj, $user->id);

                    if( $horario_disponivel ) {

                        $acompanhamento = $this->getEntityManager()->getRepository('Core\Entity\Acompanhamento')
                            ->findOneBy(array('id' => $id_acompanhamento));

                        $obj->addIdAcompanhamento($acompanhamento);
                        $acompanhamento->addIdAgenda($obj);
                        $this->getEntityManager()->persist($obj);
                        $this->getEntityManager()->flush();
                        $this->messages()->flashSuccess('Agendamento criado com sucesso.');
                        return $this->redirect()->toRoute('acompanhamento',array('action' => 'detalhes','id'=>$id_acompanhamento));

                    } else {
                        $this->messages()->warning('O horário selecionado não está disponível');
                    }
                } catch (\Exception $e) {
                    $this->messages()->error('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                }
            }  else {  echo "teste";}
      }

      $viewModel = new ViewModel($params);
      $viewModel->setVariable('title', 'Novo Agendamento');
      $viewModel->setTemplate('psicologia/agendamento/salvar.phtml');

      return $viewModel;
    }
}
