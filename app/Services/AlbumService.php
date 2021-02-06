<?php


namespace App\Services;

use App\Models\Album;
use App\Exceptions\DeleteAlbumException;
use App\Exceptions\UnsupportedPhotoFormatException;
use App\Exceptions\UpdateAlbumException;
use App\Http\Requests\AlbumUpdateRequest;
use App\Repositories\AlbumsRepository;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AlbumPhotoService
 * @package App\Services
 */
class AlbumService
{
    /**
     * @var array
     */
    private array $data;
    /**
     * @var AlbumsRepository
     */
    private AlbumsRepository $albumRepository;

    /**
     * @var AlbumEditor
     */
    private AlbumEditor $editor;

    /**
     * AlbumPhotoService constructor.
     * @param AlbumsRepository $albumRepository
     * @param AlbumEditor $editor
     */
    public function __construct(AlbumsRepository $albumRepository, AlbumEditor $editor)
    {
        $this->albumRepository = $albumRepository;
        $this->editor = $editor;
    }


    /**
     * @param FormRequest $request
     * @param Album $album
     * @throws UnsupportedPhotoFormatException
     * @throws \Throwable
     */
    public function saveAlbum(FormRequest $request, Album $album)
    {
        $this->data = $request->all();
        $album->fill($this->data)->saveOrFail();

        $this->processUpdateCover($request, $album);
        $this->processUploadPhotos($request, $album);
        $this->updateAlbumEntity($request, $album);
    }

    /**
     * @param AlbumUpdateRequest $request
     * @param int $id
     * @throws UnsupportedPhotoFormatException
     * @throws Exception
     */
    public function updateAlbum(AlbumUpdateRequest $request, int $id) : void
    {
        $this->data = $request->all();
        $album = $this->albumRepository->getAlbumWithPhotosById($id);

        $this->processUpdateCover($request, $album);
        $this->processUploadPhotos($request, $album);
        $this->processDeletedPhotos($request);
        $this->updateAlbumEntity($request, $album);
    }

    /**
     * @param FormRequest $request
     * @param Album $album
     * @throws UnsupportedPhotoFormatException
     */
    private function processUpdateCover(FormRequest $request, Album $album) : void
    {
        if ($request->hasFile('album_img')) {
            $this->data['album_img'] = $this->editor->updateCover($request, $album);
        }
    }

    /**
     * @param FormRequest $request
     * @param Album $album
     * @throws UnsupportedPhotoFormatException
     */
    private function processUploadPhotos(FormRequest $request, Album $album) : void
    {
        $this->editor->uploadPhotos($request, $album->id);
    }

    /**
     * @param AlbumUpdateRequest $request
     */
    private function processDeletedPhotos(AlbumUpdateRequest $request) : void
    {
        if ($request->has('photosToDelete')){
            $this->editor->deletePhotosFromAlbum($request->photosToDelete);
        }
    }

    /**
     * @param AlbumUpdateRequest $request
     * @param Album $album
     * @throws Exception
     */
    private function updateAlbumEntity(FormRequest $request, Album $album) : void
    {
        if(!$album->update($this->data)) {
            throw new UpdateAlbumException();
        }
    }

    private function processSaveAlbum($album)
    {
        $album->fill($this->data)->saveOrFail();
        $id = $album->id;
    }

    /**
     * @param $id
     * @throws DeleteAlbumException
     */
    public function deleteAlbum($id)
    {
        if (!Album::destroy($id)){
            throw new DeleteAlbumException();
        }
    }
}
