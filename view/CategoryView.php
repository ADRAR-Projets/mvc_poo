<?php

namespace view;

require_once './src/abstracts/View.php';

use abstracts\View;

class CategoryView extends View {

    private string $message = "";
    private? string $categoriesList = "";

    public function getCategoriesList(): string
    {
        return $this->categoriesList;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setCategoriesList(string $categoriesList): void
    {
        $this->categoriesList = $categoriesList;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


    public function displayView(?string $layout = null): string
    {
        return '
            <section>
                <form method="post" action="">
                    <input type="text" name="name" placeholder="name">
                    <button type="submit" name="submit">Ajouter</button>
                </form>
            </section>

            <p>'.  $this->getMessage() .'</p>
            <ul>
                <li>'. $this->getCategoriesList() .'</li>
            </ul>
    ';
    }
}