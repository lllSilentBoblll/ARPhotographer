<?php
//TODO изменить имя класса hover "steve" на другой в set1.css и photosGallery
namespace App\Http\Controllers;

use App\Repositories\PhotosRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Arr;
use Illuminate\View\View;


class IndexController extends SiteController
{

    public function __construct(PhotosRepository $photosRepository)
    {
        parent::__construct();
        $this->photosRepository = $photosRepository;
    }

    /**
     * @return Application|Factory|View
     * @throws \Throwable
     */
    public function index()
    {
        $this->template = 'album.index';
        $photos = $this->photosRepository->getAllWithPaginate(['imgName'], 20); //TODO сделать подгрузку закэшированых рандомных фото
        $photosGallery = view('album.photosGallery', compact('photos'))->render();
        $this->vars = Arr::add($this->vars , 'photosGallery' , $photosGallery);
        return $this->renderOutput();
    }


    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

}
