<?php

namespace view;

use abstracts\View;

require_once './src/abstracts/View.php';


class AccountView extends View
{

    private array $user = [];

    public function getUser(): array
    {
        return $this->user;
    }

    public function setUser(array $user): array
    {
        return $this->user = $user;
    }

    public function displayView(?string $layout = null): string
    {
        return 'Bienvenue ' . $this->getUser()['nickname'] . ' vous etes le numéro ' . $this->getUser()['id'] . ' et votre adresse e-mail est ' . $this->getUser()['email'];
    }
}