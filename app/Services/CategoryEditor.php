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
     * Запрет удаления первой (дефолтной) категории.
     * Deny to delete first (default) category.
     * @param $id
     * @return int
     */
    public function deleteCategory($id)
    {
        if ($id != 1) {
            return $this->categoryRepository->delete($id);
        }
        return 0;
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
