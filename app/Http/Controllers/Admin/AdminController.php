<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    //
    protected $user;
    protected $template;
    protected $title;
    protected $vars;


    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        return view($this->template)->with($this->vars);
    }
}
