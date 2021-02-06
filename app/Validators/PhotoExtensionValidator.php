<?php


namespace App\Validators;


use App\Enum\PhotoFormatsEnum;
use App\Exceptions\UnsupportedPhotoFormatException;
use Illuminate\Http\UploadedFile;

class PhotoExtensionValidator
{
    /**
     * Проверяем на соответствие расширения файла
     * File extension validation

     *
     * @param $key
     * @param UploadedFile $photo
     *
     * @throws UnsupportedPhotoFormatException
     */
    public function checkExtension(UploadedFile $photo, $key = null) : void
    {
        if (!array_key_exists($photo->extension(), PhotoFormatsEnum::ALLOWED_FORMATS)){
            $message = __('infoMessages.invalidFormat') . (is_null($key)
                    ? __('infoMessages.file') . '[' . $photo->getClientOriginalName() . ']'
                    : ++$key . ' ' . __('infoMessages.file') . '[' . $photo->getClientOriginalName() . ']' );
            throw new UnsupportedPhotoFormatException($message);
        }
    }
}
