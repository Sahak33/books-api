<?php

namespace App\Service\Category;

use App\Repository\CategoryRepository;
class CategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ){

    }
    public function getCats() :array
    {
        $books = $this->categoryRepository->findAll();

        $data = [];
        foreach ($books as $book) {

            $data[] = [
                'id' => $book->getId(),
                'name' => $book->getName()
            ];
        }

        return $data;
    }
}