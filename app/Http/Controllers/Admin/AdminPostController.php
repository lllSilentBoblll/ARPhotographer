<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Throwable;


class AdminPostController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param PostRepository $postRepository
     * @return View
     * @throws Throwable
     */
    public function index(PostRepository $postRepository)
    {
        $this->title = 'Список постов';
        $this->template = 'album.admin.blog.blog';
        $posts = $postRepository->getAllWithPaginate([
            'id',
            'title',
            'post_cover'
        ], 10);
        $postsTable = view('album.admin.blog.postsTable', compact('posts', $posts))->render();

        $this->vars = Arr::add($this->vars, 'postsTable', $postsTable);

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Post $post
     * @return View
     * @throws Throwable
     */
    public function create(Post $post)
    {
        $this->title = 'Создание нового поста';
        $this->template = view('album.admin.postCreateOrEdit', compact('post'))->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
