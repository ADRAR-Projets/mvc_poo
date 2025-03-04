<?php

namespace view\components;

require_once './src/abstracts/View.php';

use abstracts\View;

class Layout extends View {

    public function displayView(?string $layout = null): string
    {
        die($layout);

        return '
                <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
            '. $layout .'
            </body>
            </html>
        ';
    }
}