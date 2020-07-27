<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Repositories\CategoryRepository;
use App\Services\CategoryEditor;
use App\Validators\CategoryValidator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class AdminCategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    private CategoryRepository $categoryRepository;
    private CategoryEditor $editor;
    private CategoryValidator $categoryValidator;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryEditor $editor,
        CategoryValidator $categoryValidator)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->editor = $editor;
        $this->categoryValidator = $categoryValidator;
    }

    /**
     * @return View
     */
    public function index()
    {
        $this->title = 'Категории';
        $this->template = 'album.admin.category.categories';
        $categories = $this->categoryRepository->getCategoryList();
        $this->vars = Arr::add($this->vars, 'categories' , $categories);
        return $this->renderOutput();
    }

    /**
     * @param Category $category
     * @return View
     */
    public function create(Category $category)
    {
        $this->title = 'Создание новой категории';
        $this->template = 'album.admin.category.categoryCreate';
        $this->vars = Arr::add($this->vars, 'category', $category);
        return $this->renderOutput();
    }

    /**
     * @param CategoryCreateRequest $categoryCreateRequest
     * @param Category $category
     * @return RedirectResponse
     */
    public function store(CategoryCreateRequest $categoryCreateRequest, Category $category)
    {

        $category['title'] =  $categoryCreateRequest->input('title');
        if($category->save()){
            return redirect()->route('adminCategoryIndex')->with(['success' => 'Категория добавлена']);
        }else {
            return back()->withErrors($category)->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $this->title = 'Редактирование категории';
        $this->template = 'album.admin.category.categoryCreate';
        $category = $this->categoryRepository->getById($id);
        $this->vars = Arr::add($this->vars, 'category', $category);
        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->categoryValidator->validate($request, $id);
        if ($validatedData->fails()){
            return back()->withErrors($validatedData)->withInput();
        }
        $this->editor->updateCategory($request, $id);
        return redirect()->route('adminCategoryIndex')->with(['success' => 'Категория изменена']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->editor->deleteCategory($id);
        if ($result){
            return redirect()->route('adminCategoryIndex')->with(['success' => 'Категория удалена']);
        }else{
            return back()->withErrors(['msg' => 'Эту категорию нельзя удалять']);
        }
    }
}
