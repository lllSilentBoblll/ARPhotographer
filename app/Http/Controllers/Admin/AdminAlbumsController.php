<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Exceptions\UnsupportedPhotoFormatException;
use App\Http\Requests\AlbumCreateRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Repositories\AlbumsRepository;
use App\Repositories\CategoryRepository;
use App\Services\AlbumEditor;
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
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function store(AlbumCreateRequest $request, Album $album)
    {
        $data = $request->all();
        $album->fill($data)->saveOrFail();
        $id = $album->id;
        try {
            if ($request->hasFile('album_img')){
                $data['album_img'] = $this->editor->updateCover($request, $album);
            }
            $this->editor->uploadPhotos($request, $id);
        } catch (UnsupportedPhotoFormatException $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
//        $album->photos()->sync($request->get('photos'));     //синхронизация фотографий,  не проверенно

        $result = $album->update($data);
        if ($result) {
            return redirect()
                ->route('adminAlbumsIndex')
                ->with(['success' => 'Альбом создан успешно']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка создания нового альбома'])
                ->withInput();
        }
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
     * @return RedirectResponse
     */
    public function update(AlbumUpdateRequest $request, $id)
    {
        $data = $request->all();
        $album = $this->albumRepository->getAlbumWithPhotosById($id);

        try {
            if ($request->hasFile('album_img')) {
                $data['album_img'] = $this->editor->updateCover($request, $album);
            }
            $this->editor->uploadPhotos($request, $id);
        } catch (UnsupportedPhotoFormatException $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }

        if ($request->has('photosToDelete')){
            $this->editor->deletePhotosFromAlbum($data['photosToDelete']);
            return back()->with(['success' => 'Выбранные фото были удалены']);
        }

        $result = $album->update($data);

        if ($result){
            return redirect()
                ->route('adminAlbumsIndex', $album->id)
                ->with(['success' => 'Сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Не удалось сохранить'])
                ->withInput();
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $result = Album::destroy($id);
        if($result) {
            return redirect()->route('adminAlbumsIndex')->with(['success' => 'Альбом удален']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления альбома']);
        }
    }
    public function trash()
    {
        $this->title = 'Корзина';
        $this->template = '';
        $deletedAlbums = $this->albumRepository->getAllTrashed(9);
    }
}
