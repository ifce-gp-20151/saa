<?php

namespace Application\Controller;


use Zend\View\Model\ViewModel;
use Core\Controller\ActionController;
use Zend\View\Model\JsonModel;
use Application\Form\FamiliarForm;
use Core\Entity\DadosFamiliares;

class FamiliarController extends ActionController {

    /**
    * @ var DoctrineORMEntityManager
    */

    protected $em;

    private function getEntityManager() {
        if( $this->em === null ) {
            $this->em = $this->getServiceLocator()
                ->get( 'doctrine.entitymanager.orm_default' );
        }

        return $this->em;
    }

    public function indexAction() {
        $restricao = $this->params()->fromQuery('restricao');
        $data = $this->getEntityManager()->getRepository('Core\Entity\DadosFamiliares')->listar($restricao);

        return new ViewModel(array(
            'list' => $data,
            'restricao' => $restricao,
        ));
        return new ViewModel(array());
    }

    public function criarAction() {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new FamiliarForm($objectManager);

        //valida pessoa
        $id_pessoa = (int) $this->params()->fromRoute( 'id_pessoa' );
        $pessoa = $this->getEntityManager()->getRepository('Core\Entity\Pessoa')
                    ->find($id_pessoa);
        if (!$pessoa) {
            $this->messages()->flashWarning(sprintf('Pessoa com id %d não encontrado.', $id_pessoa));
            return $this->redirect()->toRoute('familiar');
        }

        $obj = new DadosFamiliares();
        $obj->addIdPessoa($pessoa);
        $form->bind($obj);

        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()){
                try{
                    $objectManager->persist($obj);
                    $objectManager->flush();
                    $this->messages()->flashSuccess('Familiar criado com sucesso.');
                    return $this->redirect()->toRoute('familiar');
                } catch(\Exception $e){
                    $this->messages()->error('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                }
            }
        }

        $params = array(
            'form' => $form,
            'id_pessoa' => $id_pessoa
        );

        $viewModel = new ViewModel($params);
        $viewModel->setVariable('title', 'Novo Familiar');
        $viewModel->setTemplate('application/familiar/salvar.phtml');

        return $viewModel;
    }

    public function ajaxBuscarProfissaoAction() {
        $params = array();
        $term = $this->params()->fromQuery('term');
        $id = (int)$this->params()->fromQuery('id');

        try {
            if($id > 0) {
                $profissao = $this->getEntityManager()->getRepository('Core\Entity\Profissao')->find($id);
                if($profissao) {
                    $params['id'] = $id;
                    $params['text'] = $profissao->getDescricao();
                } else {
                    $params['error'] = sprintf('Profissão %d não encontrada.', $id);
                }
            } else {
                $profissao = $this->getEntityManager()->getRepository('Core\Entity\Profissao')->ajaxBuscarProfissao($term);
                if ($profissao) {
                    $params['rows'] = $profissao;
                } else {
                    $params['error'] = sprintf('Profissão %s não encontrada.', $term);
                }
            }
        }
        catch(\Exception $e) {
            $params['error'] = 'Ocorreu um erro ao buscar. Detalhes: ' . $e->getTraceAsString();
        }
        return new JsonModel($params);
    }

    public function ajaxBuscarGrauParentescoAction() {
        $params = array();
        $term = $this->params()->fromQuery('term');

        try {
            $grauParentesco = $this->getEntityManager()->getRepository('Core\Entity\GrauParentesco')->ajaxBuscarGrauParentesco($term);
            if ($grauParentesco) {
                $params['rows'] = $grauParentesco;
            } else {
                $params['error'] = sprintf('Profissão %s não encontrada.', $term);
            }
        }
        catch(\Exception $e) {
            $params['error'] = 'Ocorreu um erro ao buscar. Detalhes: ' . $e->getTraceAsString();
        }
        return new JsonModel($params);
    }

    public function editarAction() {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new FamiliarForm($objectManager);

        $id = (int) $this->params()->fromRoute('id');
        $id_pessoa = (int) $this->params()->fromRoute('id_pessoa');

        if( !$id ) {
            $this->messages()->flashWarning('Familiar não informado!');
            return $this->redirect()->toRoute('familiar');
        }

        if( !$id_pessoa ) {
            $this->messages()->flashWarning('Pessoa não informada!');
            return $this->redirect()->toRoute('familiar');
        }

        $obj = $this->getEntityManager()->find( 'Core\Entity\DadosFamiliares', $id );
        if( !$obj ) {
            $this->messages()->flashWarning( 'Familiar não encontrado!' );
            return $this->redirect()->toRoute(
                'familiar', array(
                    'action' => 'index',
                    'id' => $id,
                    'id_pessoa' => $id_pessoa,
                )
            );
        }

        $form->bind( $obj );
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if($form->isValid()) {
                try {
                    $data = $form->getData();

                    //validar profissao
                    $profissao = $this->getEntityManager()->getRepository('Core\Entity\Profissao')
                        ->find($data->getIdProfissao());
                    if (! $profissao) {
                        $this->messages()->flashWarning(sprintf('Profissão com id %d não encontrada.', $data->getIdContato()));
                        return $this->redirect()->toRoute(
                            'familiar', array(
                                'action' => 'index',
                                'id' => $id,
                                'id_pessoa' => $id_pessoa,
                            )
                        );
                    }

                    //validar grau de parentesco
                    $grauParentesco = $this->getEntityManager()->getRepository('Core\Entity\GrauParentesco')
                        ->find($data->getIdGrauParentesco() );
                    if (! $grauParentesco) {
                        $this->messages()->flashWarning(sprintf('Grau de parentesco com id %d não encontrado.', $data->getIdContato()));
                        return $this->redirect()->toRoute(
                            'familiar', array(
                                'action' => 'index',
                                'id' => $id,
                                'id_pessoa' => $id_pessoa,
                            )
                        );
                    }

                    $obj->setIdProfissao($profissao);
                    $obj->setIdGrauParentesco($grauParentesco);
                    $objectManager->flush();
                    $this->messages()->flashSuccess('Dados familiares atualizados com sucesso.');

                    return $this->redirect()->toRoute(
                        'familiar', array(
                            'action' => 'index',
                            'id' => $id,
                            'id_pessoa' => $id_pessoa,
                        )
                    );
                }
                catch (\Exception $e) {
                    $this->messages()->flashError('Ocorreu um erro ao editar. Detalhes: ' . $e->getMessage());
                }
            }
        }

        $contatos = $this->getEntityManager()->getRepository('Core\Entity\Contato')
            ->listarPorFamiliar( $id );

        $viewModel = new ViewModel(
            array(
                'form' => $form,
                'id' => $id,
                'id_pessoa' => $id_pessoa,
                'obj' => $obj,
                'contatos' => $contatos,
            )
        );
        $viewModel->setTemplate('application/familiar/salvar.phtml');
        $viewModel->setVariable('title', 'Editar Familiar');

        return $viewModel;

    }
}
