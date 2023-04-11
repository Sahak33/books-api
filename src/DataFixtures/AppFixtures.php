<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\BookAuthor;
use App\Entity\BookCategory;
use App\Entity\Category;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function __construct(
        protected BookRepository $bookRepository,
        protected CategoryRepository $categoryRepository,
        protected AuthorRepository $authorRepository
    ){

    }

    public function load(ObjectManager $manager): void
    {
        $manager = $this->fillRandomBooks($manager);
        $manager = $this->fillRandomCategories($manager);
        $manager = $this->fillRandomAuthors($manager);
        $manager->flush();
        // Please don't remove the duble "$manager->flush();" code it's done course of important reason
        $manager = $this->fillBookCategoryPivot($manager);
        $manager = $this->fillBookAuthorPivot($manager);
        $manager->flush();
    }

    protected function fillRandomBooks($manager)
    {
        for ($i = 0; $i < 9; $i++) {
            $date = new DateTime();
            $randomTimestamp = mt_rand($date->modify('-10 years')->getTimestamp(), $date->getTimestamp());
            $randomDateTime = new DateTime('@'.$randomTimestamp);
            $formattedDateTime = $randomDateTime->format('Y-m-d\TH:i:s.uP');

            $item = new Book();
            $item->setTitle("Test title ".rand(100000, 999999));
            $item->setIsbn(rand(1000000000, 9999999999));
            $item->setPageCount(rand(5, 500));
            $item->setPublished([
                "date" => $formattedDateTime,
                "price" => rand(10, 200),
                "currency" => "USD"
            ]);
            $item->setThumbnailUrl("https://s3.amazonaws.com/AKIAJC5RLADLUMVRPFDQ.book-thumb-images/ableson.jpg");
            $item->setShortDescription("Description example"); // set random lorem ipsum text
            $item->setStatus("PUBLISH");

            $manager->persist($item);
        }

        return $manager;
    }

    protected function fillRandomCategories($manager)
    {
        $cats_arr = [
            'Java',
            'Software enginiering',
            'Develop',
            'Hesoyam',
            'Aezakmi',
            'Lorem ipsum'
        ];
        for ($i = 0; $i < count($cats_arr); $i++) {
            $item = new Category();
            $item->setName($cats_arr[$i]);
            $manager->persist($item);
        }

        return $manager;
    }

    protected function fillRandomAuthors($manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $item = new Author();
            $item->setName("Author".rand(100000, 999999));
            $manager->persist($item);
        }

        return $manager;
    }

    protected function fillBookCategoryPivot($manager)
    {
        $books = $this->bookRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        for ($i = 0; $i < 5; $i++) {
            $randomBookIndex = rand(0, count($books) - 1);
            $randomCatIndex = rand(0, count($categories) - 1);

            $randomBook = $books[$randomBookIndex];
            $randomCat = $categories[$randomCatIndex];

            $item = new BookCategory();
            $item->setBook($randomBook);
            $item->setCategory($randomCat);
            $manager->persist($item);
        }

        return $manager;
    }

    protected function fillBookAuthorPivot($manager)
    {
        $books = $this->bookRepository->findAll();
        $authors = $this->authorRepository->findAll();
        for ($i = 0; $i < 5; $i++) {
            $randomBookIndex = rand(0, count($books) - 1);
            $randomAuthorIndex = rand(0, count($authors) - 1);

            $randomBook = $books[$randomBookIndex];
            $andomAuthor = $authors[$randomAuthorIndex];

            $item = new BookAuthor();
            $item->setBook($randomBook);
            $item->setAuthor($andomAuthor);
            $manager->persist($item);
        }

        return $manager;
    }
}
