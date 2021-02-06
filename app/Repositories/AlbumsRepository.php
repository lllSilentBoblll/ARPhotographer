<?php


namespace App\Repositories;

use App\Models\Album;
use App\Models\Album as Model;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;


/**
 * Class AlbumsRepository
 * @package App\Repositories
 * @property Album model
 */
class AlbumsRepository extends Repository
{
    /**
     *  ($model == Album)
     * @return string
     */
    protected function getModelClass() : string
    {
        return Model::class;
    }


    /**
     * Возвращает список альбомов (с id и title из таблицы category) в порядке "сначала новые"
     *
     * @param array $columns
     * @param null $perPage
     * @return Paginator
     */
    public function getAllWithPaginate($columns = ['*'], $perPage = null): Paginator
    {
        $paginator = $this
            ->startCondition()
            ->select($columns)
            ->withCount('photos')
            ->orderBy('id', 'DESC')
            ->with(['category:id,title'])
            ->paginate($perPage);

        return $paginator;
    }

    /**
     * @param $perPage
     * @return Paginator
     */
    public function getAllTrashed($perPage) : Paginator//todo ребусы еще те, написал эту дичь тупо наугад
    {
        $paginator = $this
            ->startCondition()
            ->onlyTrashed()
            ->with(['category:id,title'])
            ->paginate($perPage);
        return $paginator;
    }


    /**
     * Получить модель из БД.
     * @param $id
     * @return Album

     */
    public function getAlbum($id)
    {
        return $this->startCondition()->find($id);
    }


    /**
     * Получить альбом с фотографиями
     * @param int $id
     * @return Album
     */
    public function getAlbumWithPhotosById($id) :Album
    {
        /** @var Album $album */
        $album = Album::find($id);
        return $album->load('photos');
    }

    /**
     * @param $imgNames
     * @param $id
     */
    public function writePhotosToDB($imgNames, $id)
    {
        $photosAndAlbumIDs = [];
        /**
         * заполнение таблицы именами новых фотографий
         *filling in the table with the names of new photos
         */
        DB::table('photos')
            ->insert($imgNames);

        /**
         * После загрузки извлекаем id загруженных фотографий для заполнения свзязей в смежной таблице
         * After downloading, extract the id of the downloaded photos to fill in the links in the adjacent table
         */
        $insertedPhotos = DB::table('photos')
            ->select('id')
            ->whereIn('imgName', $imgNames )
            ->get();

        /**
         * заполнение смежной таблицы album_photos
         *filling adjacent table album_photos
         */
        foreach ($insertedPhotos as $photo){
            $photosAndAlbumIDs[] = ['photo_id' => $photo->id, 'album_id' => $id];
        }
        DB::table('album_photos')
            ->insert($photosAndAlbumIDs);
    }

    /**
     * @param $photosToDelete
     */
    public function deletePhotosRelations($photosToDelete)
    {
        DB::table('album_photos')->whereIn('photo_id', $photosToDelete)->delete();
//          $photosToDelete = Photo::whereIn('id', $photosToDelete); // = просто проверить потом
//          $photosToDelete->delete();                                      //  =
    }
}
