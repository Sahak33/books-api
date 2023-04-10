<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\Book\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{
    protected BookService $bookService;
    public function __construct(
        protected BookRepository $bookRepository
    ){
        $this->bookService = new BookService($this->bookRepository);
    }

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
    public function search(): JsonResponse
    {
        $books = $this->bookService->getAllBooks();

        return new JsonResponse($books, Response::HTTP_OK);
    }
}
