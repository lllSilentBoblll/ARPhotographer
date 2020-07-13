<?php

namespace Tests\Feature;

use App\Enum\PhotoFormatsEnum;
use App\Exceptions\UnsupportedPhotoFormatException;
use App\Validators\PhotoExtensionValidator;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\TestCase;

class PhotoExtensionValidatorTest extends TestCase
{
    private PhotoExtensionValidator $validator;

    public function setUp(): void
    {
        $this->validator = new PhotoExtensionValidator();
    }

    /**
     * @covers \App\Validators\PhotoExtensionValidator
     * @dataProvider protoData
     *
     * @param UploadedFile $file
     * @throws \App\Exceptions\UnsupportedPhotoFormatException
     */
    public function testCheckExtension(UploadedFile $file) : void
    {
        $this->assertNull($this->validator->checkExtension($file));
    }

    /**
     * @covers \App\Validators\PhotoExtensionValidator
     * @dataProvider protoDataFailed
     *
     * @param UploadedFile $file
     * @throws \App\Exceptions\UnsupportedPhotoFormatException
     */
    public function testCheckExtensionFailed(UploadedFile $file, string $exceptionName) : void
    {
        $this->expectException($exceptionName);
        $this->validator->checkExtension($file);
    }

    /**
     * @return array[]
     */
    public function protoData() : array
    {
        $protoFile = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
        $protoFile->method('extension')->willReturn(PhotoFormatsEnum::JPEG);

        return [
            'case valid' => [$protoFile],
        ];
    }

    /**
     * @return array[]
     */
    public function protoDataFailed() : array
    {
        $protoFile = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
        $protoFile->method('extension')->willReturn('asdw2');
        $protoFile->method('getClientOriginalName')->willReturn('test_name');

        return [
            'case invalid' => [$protoFile, UnsupportedPhotoFormatException::class],
        ];
    }
}
