<?php


namespace App\Repositories;

use App\Post;
use App\Post as Model;

class PostRepository extends Repository
{
    /**
     * @return string
     */
    protected function getModelClass() : string
    {
        return Model::class;
    }

    /**Возвращает выбранную публикацию
     * @param $id
     * @return Model
     */
    public function getPostById($id) :Post
    {
        /**
         * @var Post $post
         */
        $post = $this->model::find($id);
        return $post->load('photos');
    }
}
