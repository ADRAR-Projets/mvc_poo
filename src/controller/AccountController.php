<?php

namespace controller;

require_once './src/model/UserModel.php';
require_once './view/account/AccountView.php';
require_once './src/abstracts/Controller.php';

use abstracts\Controller;
use model\UserModel;
use view\AccountView;

class AccountController extends Controller
{

    private AccountView $accountView;
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->accountView = new AccountView();
        $this->userModel = new UserModel();
    }

    public function render(): string
    {

        if(!$this->userModel->isAuthenticated()) {
            return "tu n'es pas autorisé à accéder à cette page. Connecte toi avant.";
        }

        $user = $this->userModel->getByEmail($this->userModel->getSession());
        $this->accountView->setUser($user);
        return $this->getLayout()->displayView($this->getHeader()->displayView() . $this->accountView->displayView() . $this->getFooter()->displayView());
    }
}