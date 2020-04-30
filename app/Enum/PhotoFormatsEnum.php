<?php

namespace App\Enum;

/**
 * Class PhotoFormatsEnum
 * @package App\Enum
 */
class PhotoFormatsEnum
{
    const PNG = 'png';
    const JPG = 'jpg';
    const JPEG = 'jpeg';
    const BMP = 'bmp';
    const GIF = 'gif';

    const ALLOWED_FORMATS = [
        self::PNG => null,
        self::JPG => null,
        self::JPEG => null,
        self::BMP => null,
        self::GIF => null,
    ];
}
