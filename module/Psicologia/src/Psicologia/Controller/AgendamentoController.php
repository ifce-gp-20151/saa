<?php

namespace Psicologia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Psicologia\Form\AgendamentoForm;
use Psicologia\Form\AgendamentoFilter;
use Core\Entity\Agenda;
use Core\Entity\AcompanhamentoIndividual;

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

    public function criarAcompanhamentoAgendadoAction() {
        $id_agendamento = (int) $this->params()->fromRoute("id");
        $id_acompanhamento = (int) $this->params()->fromRoute("id_acompanhamento");

        try {

            $obj_agenda = $this->getEntityManager()->getRepository('Core\Entity\Agenda')
                ->find($id_agendamento);

            if( !$obj_agenda ) {
                $this->messages()->flashWarning('Agendamento não encontrado!');
                return $this->redirect()->toRoute(
                    'acompanhamento', array(
                    'action' => 'detalhes',
                    'id' => $id_acompanhamento,
                ));
            }

            $this->getEntityManager()->getRepository('Core\Entity\Agenda')
                ->ocorreAgendamento( $id_agendamento );

            return $this->redirect()->toRoute('acompanhamento-individual', array(
                'action' => 'criar',
                'id_acompanhamento' => $id_acompanhamento,
            ));

        } catch( \Exception $e ) {
            $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
        }

    }

    public function editarAction() {
        $id_agendamento = (int) $this->params()->fromRoute('id');
        $id_acompanhamento = (int) $this->params()->fromRoute('id_acompanhamento');
        if( !$id_agendamento ) {
            $this->messages()->flashWarning('Agendamento não informado!');
            return $this->redirect()->toRoute(
                'acompanhamento', array(
                'action' => 'detalhes',
                'id' => $id_acompanhamento,
            ));
        }

        if( !$id_acompanhamento ) {
            $this->messages()->flashWarning( 'Acompanhamento não informado!' );
            return $this->redirect()->toRoute(
                'acompanhamento', array(
                'action' => 'detalhes',
                'id' => $id_acompanhamento,
            ));
        }

        $obj = $this->getEntityManager()->find( 'Core\Entity\Agenda', $id_agendamento );
        if( !$obj ) {
            $this->messages()->flashWarning( 'Agendamento não encontrado!' );
            return $this->redirect()->toRoute(
                'acompanhamento', array(
                'action' => 'detalhes',
                'id' => $id_acompanhamento,
            ));
        }

        $form = new AgendamentoForm();
        $form->bind( $obj );

        $request = $this->getRequest();
        if ($request->isPost()) {
            $filter = new AgendamentoFilter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                try {
                    $session = $this->getServiceLocator()->get('Session');
                    $user = $session->offsetGet('user');
                    $horario_disponivel = $this->getEntityManager()->getRepository('Core\Entity\Agenda')->isHorarioDisponivel($obj, $user->id);

                    if( $horario_disponivel ) {


                        $this->getEntityManager()->flush();
                        $this->messages()->flashSuccess('Agendamento atualizado com sucesso.');
                        return $this->redirect()->toRoute(
                            'acompanhamento', array(
                                'action' => 'detalhes',
                                'id' => $id_acompanhamento,
                            )
                        );
                    } else {
                        $this->messages()->warning('O horário selecionado não está disponível');
                    }
                } catch (\Exception $e) {
                    $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                }

            }
        }

        $viewModel = new ViewModel(
            array(
                'form' => $form,
                'id' => $id_agendamento,
                'id_acompanhamento' => $id_acompanhamento,
                'obj' => $obj,
            )
        );

        $viewModel->setTemplate('psicologia/agendamento/salvar.phtml');
        $viewModel->setVariable('title', 'Editar Agendamento');

        return $viewModel;

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

            }

      }

      $viewModel = new ViewModel($params);
      $viewModel->setVariable('title', 'Novo Agendamento');
      $viewModel->setTemplate('psicologia/agendamento/salvar.phtml');

      return $viewModel;
    }
}
