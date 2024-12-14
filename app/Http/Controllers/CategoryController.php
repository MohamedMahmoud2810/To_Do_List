<?php

namespace App\Http\Controllers;

use App\DTO\CategoryDTO;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $data = CategoryDTO::fromRequest($validatedData)->toArray();
        $category = $this->categoryService->createCategory($data);
        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $validatedData = $request->validated();
        $data = CategoryDTO::fromRequest($validatedData)->toArray();
        $category = $this->categoryService->updateCategory($id, $data);
        return new CategoryResource($category);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->categoryService->deleteCategory($id);
        if ($deleted) {
            return response()->json(['message' => 'Category deleted successfully']);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function restore($id)
    {
        $category = $this->categoryService->restoreCategory($id);
        return response()->json([
            'message' => 'Category restored successfully.',
            'data' => new CategoryResource($category)
        ], 200);
    }

}
