<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\User;

use Illuminate\Http\UploadedFile;
use Storage;
use Tests\AuthUser;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class MediaAdminControllerTest extends TestCase
{
    use RefreshDatabaseCustom, AuthUser;

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_list_media(): void
    {
        $publicDisk = Storage::fake('public');
        $publicDisk->put('media/test.jpg', 'test');

        $response = $this->setUser()->get('/admin/media');

        $response->assertStatus(200);
        $response->assertSee('test.jpg');
    }

    public function test_add_media(): void
    {
        $publicDisk = Storage::fake('public');
        $folder = 'test';
        $fileName = 'test.png';

        $response = $this->setUser()->post('/admin/media', [
            'file' => UploadedFile::fake()->image($fileName),
            'path' => $folder
        ]);

        $response->assertRedirect('/admin/media');
        $response->assertSessionDoesntHaveErrors();
        $this->assertTrue($publicDisk->exists('media/' . $folder . '/' . $fileName));
    }

    public function test_duplicated_media(): void
    {
        $publicDisk = Storage::fake('public');
        $folder = 'test';
        $fileName = 'test.png';
        $filePath = $folder . '/' . $fileName;
        $publicDisk->put('media/'.$filePath, 'test');

        $response = $this->setUser()->post('/admin/media', [
            'file' => UploadedFile::fake()->image($fileName),
            'path' => $folder
        ]);

        $response->assertRedirect('/admin/media');
        $this->assertEquals( 'File already exists!', session('errors')->getBag('default')->first());
    }

    public function test_delete_media(): void
    {
        $publicDisk = Storage::fake('public');
        $filePath = 'test/test.png';
        $publicDisk->put('media/'.$filePath, 'test');

        $response = $this->setUser()->delete("/admin/media", [
            'path' => 'media/' . $filePath,
        ]);

        $response->assertRedirect('/admin/media');
        $response->assertSessionHas('success');
        $this->assertFalse($publicDisk->exists('media/' . $filePath));

    }
}
