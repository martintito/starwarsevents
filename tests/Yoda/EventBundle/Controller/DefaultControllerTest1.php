<?php
declare(strict_types=1);
namespace Yoda\EventBundle\Tests\Controller;

use PHPUnit\Framework\TestCase;

/**
 * @covers Email
 */
class DefaultController1Test extends TestCase
{
    /*public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }*/
    public function testAdd()
    {
        //$calc = new Calculator();
        //$result = $calc->add(30, 12);
 
        // ¡acierta que nuestra calculadora suma dos números correctamente!
        $this->assertEquals(42, 34); 
    }
}

//exec:
//phpunit -c app tests/Yoda/EventBundle/Controller/DefaultControllerTest.php  
