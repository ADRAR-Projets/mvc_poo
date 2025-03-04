<?php

namespace view\components;

require_once './src/abstracts/View.php';

use abstracts\View;

class Footer extends View {

    public function displayView(?string $layout = null): string
    {
        return '<footer><p>Le footer</p></footer>';
    }
}