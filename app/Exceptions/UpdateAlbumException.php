<?php


namespace App\Exceptions;

use Exception;

class UpdateAlbumException extends Exception
{
    protected $message = 'Failed to save album';
}
