<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryTest extends WebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCategoryList()
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');
        $url = $router->generate('api_category');
        $client->request('GET', $url);
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
