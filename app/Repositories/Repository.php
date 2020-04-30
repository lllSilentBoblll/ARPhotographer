<?php
namespace App\Repositories;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return Model
     */
    abstract protected function getModelClass();

    /**
     * Создает и возвращает экземпляр модели.
     *
     * @return Model
     */
    protected function startCondition()
    {
        return $this->model;
    }

    /**
     * Возвращает требуемый экземпляр модели с БД
     * @param $id
     * @return Model
     */
    public function getById($id)
    {
        return $this->model::find($id);
    }

    /**
     * Получить данные для вывода пагинатором.
     *
     * @param array $columns
     * @param int $perPage
     * @return Paginator
     */
    public function getAllWithPaginate($columns = ['*'], $perPage = 20): Paginator
    {
        $result = $this
            ->startCondition()
            ->select($columns)
            ->paginate($perPage);
        return $result;
    }

}
