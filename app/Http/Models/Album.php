<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Album
 * @package App
 * @property int id
 */
class Album extends Model
{

    protected $fillable = ['title', 'customer', 'model', 'camera', 'category_id', 'description', 'album_img'];


    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }


    public function photos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Photo::class, 'album_photos','album_id', 'photo_id');
    }
}
