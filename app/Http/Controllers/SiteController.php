<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;

class SiteController extends Controller
{
    //
    protected $photosRepository;
    protected $user;
    protected $title;
    protected $template;
    protected $vars = [];
    protected $api;

    public function __construct()
    {
//        $this->api = $api;
    }


    protected function renderOutput() {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        return view($this->template)->with($this->vars);
    }

}
