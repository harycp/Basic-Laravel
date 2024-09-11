<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileControllerTest extends TestCase
{
    public function testUploadFile()
    {
        $image = UploadedFile::fake()->image('testImage.jpg');
        $this->post('/file/upload',[
            'picture' => $image
        ])->assertSeeText("OK testImage.jpg");
    }
}
