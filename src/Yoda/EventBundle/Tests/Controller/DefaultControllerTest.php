<?php

namespace Yoda\EventBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    public function testIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test');

        //$this->assertContains('Hello <strong>test</strong> world!o', $client->getResponse()->getContent());
        // Asegura que existe al menos una etiqueta <h2>
        // con la clase 'subtitle' de CSS
        $this->assertGreaterThan(
                0, $crawler->filter('h2.olduvai')->count()
        );

        // Asegura que hay exactamente 4 etiquetas <h2> en la página
        $this->assertCount(1, $crawler->filter('h2'));

        // Asegura que el contenido de la respuesta cumple con una expresión regular
        $this->assertRegExp('/test/', $client->getResponse()->getContent());

//        // Asegura que el código de estado de la respuesta es 404
//        $this->assertTrue($client->getResponse()->isNotFound());

        // Asegura que el código de estado de la respuesta es 2xx
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}
