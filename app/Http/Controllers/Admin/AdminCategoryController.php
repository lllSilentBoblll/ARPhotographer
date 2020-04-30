<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Repositories\CategoryRepository;
use Cloudinary\Uploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class AdminCategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository, Uploader $api)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
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
        //проверка которая не будет выдавать ошибку замены названия этой же категории на такое же название
        // вот это все легко выноситься в отдельный класс, да это понятно что вынести можно, а вот куда
        // что бы это выглядило правильно, вот в доке говорится что создается файл
        $validatedData = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('categories')->ignore($id),
            ],
        ]);
        if ($validatedData->fails()){
            return back()->withErrors($validatedData)->withInput();
        }
        $category = $this->categoryRepository->getById($id);
        $category->update($request->all());
        return redirect()->route('adminCategoryIndex')->with(['success' => 'Категория изменена']);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        \DB::table('albums')->where('category_id', $id)->insert([['category_id' => 1]]);
        $result = Category::destroy($id);
        if ($result){
            return redirect()->route('adminCategoryIndex')->with(['success' => 'Категория удалена']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
