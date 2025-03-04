<?php

namespace view\components;

require_once './src/abstracts/View.php';

use abstracts\View;

class Header extends View {

    public function displayView(?string $layout = null): string
    {
        return '<header>
             <nav>
                <ul>
                  <li><a href="/">Home</a></li>
                  <li><a href="/auth">Auth</a></li>
                  <li><a href="/account">Account</a></li>
                  <li><a href="/category">Category</a></li>
               </ul>
              </nav>
            </header>
            ';
    }
}