<?php

namespace App\Service\Book;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\BookCategory;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class BookService
{
    private EntityManagerInterface $entityManager;
    public function __construct(
        protected BookRepository $bookRepository,
        EntityManagerInterface $entityManager
    ){
        $this->entityManager = $entityManager;
    }

    public function getBooks(Request $request) :array
    {
        $params = $request->query->all();
        $books = $this->bookRepository->findAll();

        // if parameters got, it must be filtered
        if($params){
            $books = $this->getBookFiltered($params);
        }

        $data = [];
        foreach ($books as $book) {
            $cats = $this->getBookCats($book);
            $authors = $this->getBookAuthors($book);

            $data[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'categories' => $cats,
                'authors' => $authors
            ];
        }

        return $data;
    }

    protected function getBookFiltered($filters)
    {
        // Get the filtered books
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('b')
            ->from(Book::class, 'b')
            ->join(BookCategory::class, 'bc', 'WITH', 'b.id = bc.Book')
            ->join(Category::class, 'c', 'WITH', 'c.id = bc.Category');

        $price = $filters['price'] ?? false;
        if ($price) {
            $queryBuilder->where("b.published LIKE '%\"price\": $price,%'");
        }

        $category = $filters['category'] ?? false;
        if ($category) {
            $queryBuilder->andWhere('c.name = :category')
                ->setParameter('category', $category);
        }

        $date = $filters['date'] ?? false;
        if ($date) {
            $queryBuilder->andWhere("b.published LIKE :date")
                ->setParameter('date', '%"date": "'.$date.'%"%');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    protected function getBookCats($book) :array
    {
        $cats = [];
        foreach ($book->getBookCategories() as $cat){
            $cats[] = $cat->getCategory()->getName();
        }
        return $cats;
    }

    protected function getBookAuthors($book) :array
    {
        $authors = [];
        foreach ($book->getBookAuthors() as $author){
            $authors[] = $author->getAuthor()->getName();
        }
        return $authors;
    }
}