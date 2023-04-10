<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{
    public function __construct(
        protected BookRepository $bookRepository
    ){

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
        $books = $this->bookRepository->findAll();

        $data = [];
        foreach ($books as $book) {
            $cats = [];
            foreach ($book->getBookCategories() as $cat){
                $cats[] = $cat->getCategory()->getName();
            }

            $authors = [];
            foreach ($book->getBookAuthors() as $author){
                $authors[] = $author->getAuthor()->getName();
            }

            $data[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'categories' => $cats,
                'authors' => $authors
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
