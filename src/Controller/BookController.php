<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BookController.php',
        ]);
    }

    /**
     * @Route("/book/search", name="book_search", methods={"GET"})
     */
    public function search(HttpClientInterface $httpClient): JsonResponse
    {
        $response = $httpClient->request('GET', 'https://run.mocky.io/v3/d7f02fdc-5591-4080-a163-95a08ce6895e');

        // Get the JSON response body and decode it
        $books = json_decode($response->getContent(), true);

        return new JsonResponse($books);
    }
}
