<?php

namespace abstracts;

require_once './view/components/Footer.php';
require_once './view/components/Header.php';
require_once './view/components/Layout.php';

use view\components\Footer;
use view\components\Header;
use view\components\Layout;

abstract class Controller
{

    private Header $header;
    private Footer $footer;
    private Layout $layout;

    public function __construct()
    {
        $this->header = new Header();
        $this->footer = new Footer();
        $this->layout = new Layout();
    }

    public function getHeader(): Header
    {
        return $this->header;
    }

    public function getFooter(): Footer
    {
        return $this->footer;
    }

    public function getLayout(): Layout
    {
        return $this->layout;
    }

    abstract public function render();
}