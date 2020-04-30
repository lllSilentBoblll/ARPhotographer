<?php


namespace App\Repositories;

use App\Photo as Model;

class PhotosRepository extends Repository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $ids
     *
     * @return Model
     */
    public function getPhotosById($ids)
    {
        return $this->model->find($ids);
    }

    /**
     * @param $photosToDelete
     */
    public function deletePhotos($photosToDelete)
    {
        $this->model->destroy($photosToDelete);
    }

}
