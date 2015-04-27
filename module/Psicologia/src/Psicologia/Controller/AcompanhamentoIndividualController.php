<?php

namespace Psicologia\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Psicologia\Form\AcompanhamentoIndividualForm;
use Core\Entity\AcompanhamentoIndividual;
use Coreproc\CryptoGuard;

class AcompanhamentoIndividualController extends ActionController {

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

    public function criarAction() {
        $id_acompanhamento = (int) $this->params()->fromRoute('id_acompanhamento');
        if (!$id_acompanhamento) {
            $this->messages()->flashWarning('Acompanhamento não informado.');
            return $this->redirect()->toRoute('acompanhamento');
        }

        $obj = $this->getEntityManager()->find('Core\Entity\Acompanhamento', $id_acompanhamento);
        if (! $obj) {
            $this->messages()->flashWarning('Acompanhamento não encontrado.');
            return $this->redirect()->toRoute('acompanhamento');
        } else {
            try {
                $entity = $this->getEntityManager()
                    ->getRepository('Core\Entity\AcompanhamentoIndividual');
                $result = $entity->buscarNumeroProximoEncontro($id_acompanhamento);

                $crypto = $this->getService('Application\Service\Crypto');
                $passphrase = $crypto->gerarHash();
                $cryptoGuard = new CryptoGuard($passphrase);
                $encryptedText = $cryptoGuard->encrypt("");

                $model = new AcompanhamentoIndividual();
                $model->setNumeroEncontro($result['max']);
                $model->setIdAcompanhamento($obj);
                $model->setDescricao($encryptedText);
                $model->setPassphrase($passphrase);
                $this->getEntityManager()->persist($model);
                $this->getEntityManager()->flush();
                return $this->redirect()->toRoute('acompanhamento-individual', array(
                    'action' => 'editar',
                    'id_acompanhamento' => $id_acompanhamento,
                    'id' => $model->getId(),
                ));
            } catch (\Exception $e) {
                $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                return $this->redirect()->toRoute('acompanhamento');
            }
        }
    }

    public function editarAction() {
        $id_acompanhamento = (int) $this->params()->fromRoute('id_acompanhamento');
        if (!$id_acompanhamento) {
            $this->messages()->flashWarning('Acompanhamento não informado.');
            return $this->redirect()->toRoute('acompanhamento');
        }

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->messages()->flashWarning('Acompanhamento Individual não informado.');
            return $this->redirect()->toRoute('acompanhamento', array(
                'action' => 'detalhes',
                'id' => $id_acompanhamento
            ));
        }

        $obj = $this->getEntityManager()->find('Core\Entity\AcompanhamentoIndividual', $id);
        if (! $obj) {
            $this->messages()->flashWarning('Acompanhamento Individual não encontrado.');
            return $this->redirect()->toRoute('acompanhamento', array(
                'action' => 'detalhes',
                'id' => $id_acompanhamento
            ));
        }
        $cryptoGuard = new CryptoGuard($obj->getPassphrase());
        $decryptedText = $cryptoGuard->decrypt($obj->getDescricao());
        $obj->setDescricao($decryptedText);

        $form = new AcompanhamentoIndividualForm();
        $form->bind($obj);

        $viewModel = new ViewModel(array(
            'form' => $form,
            'id_acompanhamento' => $id_acompanhamento,
            'obj' => $obj,
        ));
        $viewModel->setTemplate('psicologia/acompanhamento-individual/salvar.phtml');

        return $viewModel;
    }

    public function ajaxSalvarAction() {
        $params = array();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id = (int) $this->params()->fromPost('id', 0);
            $descricao = $this->params()->fromPost('descricao');
            try {
                $obj = $this->getEntityManager()->find('Core\Entity\AcompanhamentoIndividual', $id);
                if (! $obj) {
                    $params['error'] = 'Acompanhamento Individual não encontrado.';
                } else {
                    $cryptoGuard = new CryptoGuard($obj->getPassphrase());
                    $encryptedText = $cryptoGuard->encrypt($descricao);
                    $obj->setDescricao($encryptedText);
                    $this->getEntityManager()->flush();
                    $params['ok'] = true;
                }
            } catch (\Exception $e) {
                $params['error'] = 'Ocorreu um erro ao buscar. Detalhes: ' . $e->getTraceAsString();
            }
        } else {
            $params['error'] = 'Requisição não pode ser concluída.';
        }

        return new JsonModel($params);
    }
}
