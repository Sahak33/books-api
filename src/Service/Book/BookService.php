<?php

namespace App\Service\Book;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookService
{
    public function __construct(
        protected BookRepository $bookRepository
    ){

    }

    public function getAllBooks() :array
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

        return $data;
    }
}