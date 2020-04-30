<?php

namespace App\Exceptions;

use Exception;

/**
 * Class UnsupportedPhotoFormatException
 * @package App\Exceptions
 */
class UnsupportedPhotoFormatException extends Exception
{
    /**
     * @var int
     */
    protected $code = 403;

    /**
     * @var string
     */
    protected $message = 'Invalid file format';
}
