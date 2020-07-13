<?php


namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoryEditor
 * @package App\Services
 */
class CategoryEditor
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateCategory(Request $request, $id)
    {
        $category = $this->categoryRepository->getById($id);
        $category->update($request->all());
    }
}
