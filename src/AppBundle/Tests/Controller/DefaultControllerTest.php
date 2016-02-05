<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = self::createClient();

        $client->request('GET', '/');

        $this->assertTrue(
                        $client->getResponse()->isSuccessful(),
            sprintf('The %s public URL loads correctly.', '/')
        );
    }
}
