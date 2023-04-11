<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookTest extends WebTestCase
{
    public function testSearch()
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');

        $url = $router->generate('api_book_search');

        $client->request('GET', $url);
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
}
