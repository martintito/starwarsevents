<?php

namespace Yoda\EventBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Yoda\EventBundle\Controller\Calculator;

class CalculatorTest extends WebTestCase
{
    public function testAdd()
    {
        $calc = new Calculator();
        $result = $calc->add(30, 13);
 
        // ¡acierta que nuestra calculadora suma dos números correctamente!
        $this->assertEquals(42, $result);
    }
}