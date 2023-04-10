<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\Book\BookService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{
    protected BookService $bookService;
    private EntityManagerInterface $entityManager;
    public function __construct(
        protected BookRepository $bookRepository,
        EntityManagerInterface $entityManager
    ){
        $this->entityManager = $entityManager;
        $this->bookService = new BookService($this->bookRepository, $this->entityManager);
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
    public function search(Request $request): JsonResponse
    {
        $books = $this->bookService->getBooks($request);

        return new JsonResponse($books, Response::HTTP_OK);
    }

    /**
     * @Route("/book/show/{id}", name="book_show", methods={"GET"})
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->bookService->getBookById($id);

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
