<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Exceptions\DeleteAlbumException;
use App\Exceptions\UnsupportedPhotoFormatException;
use App\Http\Requests\AlbumCreateRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Repositories\AlbumsRepository;
use App\Repositories\CategoryRepository;
use App\Services\AlbumEditor;
use App\Services\AlbumService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;


/**
 * Class AdminAlbumsController
 * @package App\Http\Controllers\Admin
 */
class AdminAlbumsController extends AdminController
{
    /**
     * @var AlbumsRepository
     */
    private AlbumsRepository $albumRepository;

    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * @var AlbumEditor
     */
    private AlbumEditor $editor;

    /**
     * AdminAlbumsController constructor.
     * @param AlbumsRepository $albumRepository
     * @param CategoryRepository $categoryRepository
     * @param AlbumEditor $editor
     */
    public function __construct(
        AlbumsRepository $albumRepository,
        CategoryRepository $categoryRepository,
        AlbumEditor $editor
    ) {
        parent::__construct();
        $this->albumRepository = $albumRepository;
        $this->categoryRepository = $categoryRepository;
        $this->editor = $editor;
    }

    /**
     * @return View
     * @throws \Throwable
     */
    public function index()
    {
        $this->title = 'Список альбомов';
        $this->template = 'album.admin.albums';
        $albums = $this->albumRepository->getAllWithPaginate([
            'id',
            'album_img',
            'title',
            'category_id',
            'description'],
            9);                                          //TODO albumsTable 44 строка
        $albumsTable = view('album.admin.albumsTable', compact('albums'))->render();
        $this->vars = Arr::add($this->vars, 'albumsTable', $albumsTable);

        return $this->renderOutput();
    }

    /**
     * @param Album $album
     * @return View
     * @throws \Throwable
     */
    public function create(Album $album)
    {
        $this->title = 'Cоздание нового альбома';
        $this->template = 'album.admin.albumCreateOrEdit';
        $categories = $this->categoryRepository->getCategoryList();
        $createOrEditContent = view('album.admin.albumCreateOrEditContent',
            compact('album', 'categories'))->render();
        $this->vars = Arr::add($this->vars, 'createOrEditContent', $createOrEditContent);

        return $this->renderOutput();
    }

    /**
     * @param AlbumCreateRequest $request
     * @param Album $album
     * @param AlbumService $service
     * @throws \Throwable
     */
    public function store(AlbumCreateRequest $request, Album $album, AlbumService $service)
    {
        try {
            $service->saveAlbum($request, $album);
            $response = redirect()->route('adminAlbumsIndex')->with(['success' => __('infoMessages.albumCreated')]);
        } catch (UnsupportedPhotoFormatException $e) {
            $response = back()->withErrors(['msg' => $e->getMessage()]);
        } catch (\Exception $e) {
            $response = back()->withErrors(['msg' => __('infoMessages.createFailure')])->withInput();
        }
        return $response;
    }


    /**
     * @param $id
     * @return View
     * @throws \Throwable
     */
    public function edit($id)
    {
        $this->title = 'Редактирование альбома';
        $this->template = 'album.admin.albumCreateOrEdit';
        $album = $this->albumRepository->getAlbumWithPhotosById($id);
        $categories = $this->categoryRepository->getCategoryList();
        $createOrEditContent = view('album.admin.albumCreateOrEditContent',
                            compact('album', 'categories'))->render();
        $this->vars = Arr::add($this->vars, 'createOrEditContent', $createOrEditContent);

        return $this->renderOutput();
    }

    /**
     * @param AlbumUpdateRequest $request
     * @param $id
     * @param AlbumService $albumService
     * @return RedirectResponse
     */
    public function update(AlbumUpdateRequest $request, $id, AlbumService $albumService)
    {
        try {
            $albumService->updateAlbum($request, $id);
            $response = redirect()->route('adminAlbumsIndex')->with(['success' => 'Сохранено']);
        } catch (UnsupportedPhotoFormatException $e) {
            $response = back()->withErrors(['msg' => $e->getMessage()]);
        } catch (\Exception $e) {
            $response = back()->withErrors(['msg' => __('infoMessages.saveFailure')])->withInput();
        }
        return $response;
    }

    /**
     * @param $id
     * @param AlbumService $albumService
     * @return RedirectResponse
     */
    public function destroy($id, AlbumService $albumService)
    {
        try {
            $albumService->deleteAlbum($id);
            $response = redirect()->route('adminAlbumsIndex')->with(['success' => __('infoMessages.albumDeleted')]);
        } catch (DeleteAlbumException $e) {
            $response = back()->withErrors(['msg' => $e->getMessage()]);
        }
        return $response;
    }
}
