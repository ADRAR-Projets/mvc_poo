<?php

namespace abstracts;

abstract class View
{
    abstract public function displayView(?string $layout = null): string;

}