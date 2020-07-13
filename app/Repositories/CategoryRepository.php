<?php


namespace App\Repositories;

use App\Album;
use App\Category as Model;

class CategoryRepository extends Repository
{
    /**
     * @return string
     */
    public function getModelClass() : string
    {
        return Model::class;
    }
    /**
     * Получить список категорий для выпадающего списка.
     */
    public function getCategoryList()
    {
        return $this->startCondition()->all();
    }

    /** Если какие-то альбомы используют удаляемую категорию - заменяем эту категорию на дефолтную, а после удаляем.
     * If some albums use a deleted category, we replace this category with the default one, and then delete.
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        Album::where('category_id', $id)->update(['category_id' => 1]);
        return Model::destroy($id);
    }

}
