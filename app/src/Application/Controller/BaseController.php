<?php

namespace App\Application\Controller;
use DI\Container;

class BaseController {

    protected Container $getContainer;

    public function __construct(Container $container)
    {
        return $this->getContainer = $container;
    }

}