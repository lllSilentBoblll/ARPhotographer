<?php

namespace App\Http\Controllers\Admin;


use Illuminate\View\View;

/**
 * Class AdminIndexController
 * @package App\Http\Controllers\Admin
 */
class AdminIndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'album.admin.index';
    }

    /**
     * @return View
     */
    public function index()
    {
        $this->title = 'Панель администратора';

        return $this->renderOutput();
    }
}
