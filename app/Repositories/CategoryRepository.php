<?php


namespace App\Repositories;
use App\Category;
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

}
