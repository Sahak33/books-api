<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Entity\Category;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        protected BookRepository $bookRepository,
        protected CategoryRepository $categoryRepository
    ){

    }

    public function load(ObjectManager $manager): void
    {
        $manager = $this->fillRandomBooks($manager);
        $manager = $this->fillRandomCategories($manager);
        $manager->flush();
        // Please don't remove the duble "$manager->flush();" code it's done couse of important reason
        $manager = $this->fillBookCategoryPivot($manager);
        $manager->flush();
    }

    protected function fillRandomBooks($manager)
    {
        for ($i = 0; $i < 9; $i++) {
            $item = new Book();
            $item->setTitle("Test title ".rand(100000, 999999));
            $manager->persist($item);
        }

        return $manager;
    }

    protected function fillRandomCategories($manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $item = new Category();
            $item->setName("Cat".rand(100000, 999999));
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
}
