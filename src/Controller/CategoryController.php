<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Service\Category\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    protected CategoryService $categoryService;

    public function __construct(
        protected CategoryRepository $categoryRepository
    ){
        $this->categoryService = new CategoryService($this->categoryRepository);
    }

    #[Route('/category', name: 'app_category')]
    public function index(Request $request): JsonResponse
    {
        $books = $this->categoryService->getCats($request);

        return new JsonResponse($books, Response::HTTP_OK);
    }
}
