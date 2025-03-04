<?php

namespace view;

require_once './src/abstracts/View.php';

use abstracts\View;

class AuthView extends View
{

    private string $message = "";

    private string $messageConnexion = "";

    private? string $usersList = "";

    public function getUsersList(): string
    {
        return $this->usersList;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMessageConnexion(): string
    {
        return $this->messageConnexion;
    }

    public function setUsersList(string $usersList): void
    {
        $this->usersList = $usersList;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setMessageConnexion(string $message): void
    {
        $this->messageConnexion = $message;
    }

    public function displayView(?string $layout = null): string
    {
        return '
            <section>
                <form method="post" action="">
                    <input type="text" name="username" placeholder="username" >
                    <input type="email" name="email" placeholder="email">
                    <input type="password" name="password" placeholder="password" >
                    <button type="submit" name="submit">Inscription</button>
                </form>
            </section>
            <section>
                <form method="post" action="">
                    <input type="email" name="email" placeholder="email">
                    <input type="password" name="password" placeholder="password" >
                    <button type="submit" name="submit">Connexion</button>
                </form>
            </section>
            <p>'.  $this->getMessage() .'</p>
            <p>'.  $this->getMessageConnexion() .'</p>  
            <ul>
                <li>'. $this->getUsersList() .'</li>
            </ul>
    ';
        
    }
}