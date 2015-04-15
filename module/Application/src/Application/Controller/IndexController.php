<?php

namespace Application\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Application\Service\Auth;

class IndexController extends ActionController {

    /**
     * Mapped as
     *    /
     */
    public function indexAction() {
        $session = $this->getServiceLocator()->get('Session');
        $user = $session->offsetGet('user');
        switch ($user->role_id) {
            case Auth::ROLE_ID_ADMIN:
                return $this->redirect()->toRoute('admin');
            case Auth::ROLE_ID_PSICOLOGIA:
                return $this->redirect()->toRoute('psicologia');
        }
    }

    /**
     * Mapped as
     *   /about
     */
    public function aboutAction() {
        // static about page
    }
}
