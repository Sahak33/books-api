<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookTest extends WebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }
    public function testSearch()
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');

        $url = $router->generate('api_book_search');

        $client->request('GET', $url);
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSearchFilterPrice()
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');
        $url = $router->generate('api_book_search');

        $client->request('GET', $url);
        $response = $client->getResponse();
        $books = json_decode($response->getContent());
        $sample_price = 0;
        foreach ($books as $book){
            $arrayData = json_decode(json_encode($book->published), true);
            $item = $arrayData['price'] ?? null;
            if($item){
                $sample_price = $item;
            }
        }

        $url = $router->generate('api_book_search', ['price' => $sample_price]);

        $client->request('GET', $url);
        $response = $client->getResponse();
        $result = json_decode($response->getContent());

        $this->assertTrue(count($result) > 0);
    }

    public function testSearchFilterDate()
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');
        $url = $router->generate('api_book_search');

        $client->request('GET', $url);
        $response = $client->getResponse();
        $books = json_decode($response->getContent());
        $sample_price = 0;
        foreach ($books as $book){
            $arrayData = json_decode(json_encode($book->published), true);
            $item = $arrayData['date'] ?? null;
            if($item){
                $sample_price = $item;
            }
        }

        $url = $router->generate('api_book_search', ['date' => $sample_price]);

        $client->request('GET', $url);
        $response = $client->getResponse();
        $result = json_decode($response->getContent());

        $this->assertTrue(count($result) > 0);
    }

    public function testSearchFilterCategory()
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');
        $url = $router->generate('api_book_search');

        $client->request('GET', $url);
        $response = $client->getResponse();
        $books = json_decode($response->getContent());
        $sample_price = 0;
        foreach ($books as $book){
            $arrayData = json_decode(json_encode($book->published), true);
            $item = $arrayData['date'] ?? null;
            if($item){
                $sample_price = $item;
            }
        }

        $url = $router->generate('api_book_search', ['date' => $sample_price]);

        $client->request('GET', $url);
        $response = $client->getResponse();
        $result = json_decode($response->getContent());

        $this->assertTrue(count($result) > 0);
    }
}
