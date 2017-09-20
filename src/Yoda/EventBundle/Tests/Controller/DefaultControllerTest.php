<?php

namespace Yoda\EventBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    public function testIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test');

        //$this->assertContains('Hello <strong>test</strong> world!o', $client->getResponse()->getContent());
        //testttttttt
        $this->assertGreaterThan(
                0, $crawler->filter('h2.olduvai')->count()
        );
    }

}
