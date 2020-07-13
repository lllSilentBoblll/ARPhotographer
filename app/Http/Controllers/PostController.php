<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Support\Arr;

class PostController extends SiteController
{

    protected $blogPostRepository;

    public function __construct(PostRepository $blogPostRepository)
    {
        parent::__construct();
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * @return \Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $this->title = 'Блог';
        $this->template = 'album.blogIndex';
        $posts = $this->blogPostRepository->getAllWithPaginate([
            'id',
            'post_cover',
            'title',
            'user_id'
        ], 6 );
        $this->vars = Arr::add($this->vars, 'posts', $posts);
        return $this->renderOutput();
    }


    public function show($id)
    {
        $this->title ='';
    }

}
