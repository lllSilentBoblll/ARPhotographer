<?php

namespace App\Observers;

use App\Models\Album;

class AlbumObserver
{
    /**
     * Handle the album "created" event.
     *
     * @param Album $album
     * @return void
     */
    public function created(Album $album)
    {
        //
    }

    /**
     * Handle the album "updated" event.
     *
     * @param Album $album
     * @return void
     */
    public function updated(Album $album)
    {
        //

    }

    /**
     * @param Album $album
     */
    public function deleting(Album $album)
    {
//        dd(__METHOD__, $album);
    }

    /**
     * Handle the album "deleted" event.
     *
     * @param Album $album
     * @return void
     */
    public function deleted(Album $album)
    {
        //
    }

    /**
     * Handle the album "restored" event.
     *
     * @param Album $album
     * @return void
     */
    public function restored(Album $album)
    {
        //
    }

    /**
     * Handle the album "force deleted" event.
     *
     * @param Album $album
     * @return void
     */
    public function forceDeleted(Album $album)
    {
        //
    }
}
