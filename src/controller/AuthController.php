<?php

namespace controller;

require_once './src/model/UserModel.php';
require_once './view/auth/AuthView.php';
require_once './src/abstracts/Controller.php';

use abstracts\Controller;
use model\UserModel;
use view\AuthView;

class AuthController extends Controller
{

    private AuthView $authView;
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->authView = new AuthView();
        $this->userModel = new UserModel();
    }

    public function login(): string {
        if (isset($_POST["submit"])) {
            if (!empty($_POST["email"]) && !empty($_POST["password"])) {


                $user = $this->userModel->getByEmail($_POST["email"]);

                if (empty($user)) {
                    return "Identifiant ou mot de passe invalide.";
                }

                $passwordHash = $this->userModel->getPasswordHashByEmail($_POST['email']);

                if(!password_verify($_POST['password'],$passwordHash['psswrd'])) {
                    return "Identifiant ou mot de passe invalide.";
                }

                $this->userModel->setId($user['id']);
                $this->userModel->setNickname($user['nickname']);
                $this->userModel->setEmail($user['email']);
                $this->userModel->createSession();
                return "Vous etes connecté.";
            } else {
               return "veuillez remplir les champs...";
            }
        } else {
            return "wait... login.";
        }
    }

    public function register(): string
    {
        if (isset($_POST["submit"])) {
            if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty(($_POST['username']))) {

                $exists = $this->userModel->getByEmail($_POST["email"]);

                if (!empty($exists)) {
                    return "L'adresse e-mail est déjà utilisé.";
                }

                $this->userModel->setNickname($_POST['username']);
                $this->userModel->setEmail($_POST['email']);
                $this->userModel->setPassword($_POST['password']);

                $this->userModel->add();
                return !empty($this->userModel->getByEmail($this->userModel->getEmail())) ? 'Utilisateur ajouté avec succès.' : 'L\'utilisateur n\'a pas été ajouté.';
            } else {
                return 'Veuillez remplir les champs.';
            }
        } else {
            return "wait...";
        }
    }

    private function getAll(): string
    {
        $usersList = "";

        $users = $this->userModel->getAll();

        foreach ($users as $user) {
            $usersList .= "<li>ID: {$user['id']}, Pseudo: {$user['nickname']}, Email: {$user['email']}</li>";
        }

        return $usersList;
    }


    public function render(): string
    {
        $this->authView->setMessage($this->register());
        $this->authView->setMessageConnexion($this->login());
        $this->authView->setUsersList($this->getAll());

        return $this->getLayout()->displayView($this->getHeader()->displayView() . $this->authView->displayView() . $this->getFooter()->displayView());
    }
}