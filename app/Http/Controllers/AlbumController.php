<?php

namespace App\Http\Controllers;

use App\Repositories\AlbumsRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class AlbumController extends SiteController
{
    /**
     * @var AlbumsRepository
     */
    protected $albumRepository;

    /**
     * AlbumController constructor.
     * @param AlbumsRepository $albumRepository
     */
    public function __construct(AlbumsRepository $albumRepository)
    {
        parent::__construct();
        $this->albumRepository = $albumRepository;
    }


    /**
     * Список альбомов
     * @return View
     * @throws \Throwable
     */
    public function index()
    {
        $this->title = 'Главная';
        $this->template = 'album.albums';
        $albums = $this->albumRepository->getAllWithPaginate([
            'id',
            'title',
            'album_img',
            'category_id',
            'description'], 10);
        $albumsGallery = view('album.albumsGallery', compact('albums'))->render();
        $this->vars = Arr::add($this->vars, 'albumsGallery', $albumsGallery);

        return $this->renderOutput();

    }

    /**
     * Альбом детально
     * @param int $id
     * @return View
     * @throws \Throwable
     */
    public function show($id)
    {
        $this->template = 'album.albumDetails';
        $album = $this->albumRepository->getAlbumWithPhotosById($id);
        $albumContent = view('album.albumContent', compact('album'))->render();
        $this->vars = Arr::add($this->vars, 'albumContent', $albumContent);
        return $this->renderOutput();
    }

}
