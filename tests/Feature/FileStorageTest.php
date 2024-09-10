<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk('public'); 
        $filesystem->put('file.txt', "Hello Hary Capri");

        $content = $filesystem->get('file.txt');
        $this->assertEquals("Hello Hary Capri", $content);
        
    }
}
