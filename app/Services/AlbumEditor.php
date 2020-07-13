<?php
namespace App\Services;

use App\Album;
use App\Exceptions\UnsupportedPhotoFormatException;
use App\Repositories\AlbumsRepository;
use App\Repositories\PhotosRepository;
use App\Validators\PhotoExtensionValidator;
use Cloudinary\Uploader;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AlbumEditor
{
    private Uploader $api;
    private AlbumsRepository $albumRepository;
    private PhotosRepository $photoRepository;
    private PhotoExtensionValidator $photoValidator;

    /**
     * AlbumUpdater constructor.
     * @param Uploader $api
     * @param AlbumsRepository $albumRepository
     * @param PhotosRepository $photosRepository
     * @param PhotoExtensionValidator $photoValidator
     */
    public function __construct(
        Uploader $api,
        AlbumsRepository $albumRepository,
        PhotosRepository $photosRepository,
        PhotoExtensionValidator $photoValidator
    )
    {
        $this->api = $api;
        $this->albumRepository = $albumRepository;
        $this->photoRepository = $photosRepository;
        $this->photoValidator = $photoValidator;
    }



    /**
     * Создаем уникальные имена для фотографий и добавляем к ним расширение файла
     * Загружаем через Cloudinary api в облако
     * Create unique names for photos and add a file extension to them
     * Upload photo with Cloudinary api in cloud
     *
     * @param Request $request
     * @param $id
     *
     * @throws UnsupportedPhotoFormatException
     */
    public function uploadPhotos(Request $request, $id)
    {
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $imgNames = [];

            foreach ($photos as $key => $photo){
                $this->photoValidator->checkExtension($photo, $key);
                $imgName = Str::uuid()->toString();
                $imgNames[] = ['imgName' => $imgName . '.' . $photo->extension()]; //наполнение массива с именами файлов для заполнения поля imgName в таблице Photos
                $this->api->upload($photo, ["public_id" => $imgName]);
            }
            $this->albumRepository->writePhotosToDB($imgNames, $id);
        }
    }

    /** Создание/обновление обложки альбома
     *  Albums cover update
     *
     * @param Request $request
     * @param $album
     * @return string
     * @throws UnsupportedPhotoFormatException
     */
    public function updateCover(Request $request, Album $album)
    {
            $albumImg = $request->file('album_img');
            $this->photoValidator->checkExtension($albumImg);
            $newCoverName = Str::uuid()->toString();
            $this->api->upload($albumImg, ["public_id" => $newCoverName]);
            $newCoverName .= '.' . $albumImg->extension();
            if (!is_null($album->album_img)){
                $oldAlbumCover = $album->album_img;
                $this->api->destroy($oldAlbumCover);
            }
            return $newCoverName;
    }

    /**
     * @param $photosToDeleteIDS
     */
    public function deletePhotosFromAlbum($photosToDeleteIDS)
    {
        $photosToDelete = $this->photoRepository->getPhotosById($photosToDeleteIDS); //todo что лучше, доставать модели или сделать запрос чисто на имена картинок?
        $this->albumRepository->deletePhotosRelations($photosToDeleteIDS);
        $this->photoRepository->deletePhotos($photosToDeleteIDS);

        foreach ($photosToDelete as $photo){
            $imgName = stristr($photo->imgName, '.', true);
            $this->api->destroy($imgName);
        }
    }
}
