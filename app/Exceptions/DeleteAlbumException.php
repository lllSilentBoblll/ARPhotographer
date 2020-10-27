<?php


namespace App\Exceptions;

use Exception;

/**
 * Class DeleteAlbumException
 * @package App\Exceptions
 */
class DeleteAlbumException extends Exception
{
    protected $message = 'Не удалось удалить альбом';
}
