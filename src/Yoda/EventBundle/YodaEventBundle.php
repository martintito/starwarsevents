<?php

namespace Yoda\EventBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class YodaEventBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}