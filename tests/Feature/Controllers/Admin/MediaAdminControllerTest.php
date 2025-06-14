<?php

use Illuminate\Http\UploadedFile;

uses(\Tests\AuthUser::class);
uses(\Tests\RefreshDatabaseCustom::class);

afterEach(function () {
});

test('list media', function () {
    $publicDisk = Storage::fake('public');
    $publicDisk->put('media/test.jpg', 'test');

    $response = $this->setUser()->get('/admin/media');

    $response->assertStatus(200);
    $response->assertSee('test.jpg');
});

test('add media', function () {
    $publicDisk = Storage::fake('public');
    $folder = 'test';
    $fileName = 'test.png';

    $response = $this->setUser()->post('/admin/media', [
        'file' => UploadedFile::fake()->image($fileName),
        'path' => $folder,
    ]);

    $response->assertRedirect('/admin/media');
    $response->assertSessionDoesntHaveErrors();
    expect($publicDisk->exists('media/'.$folder.'/'.$fileName))->toBeTrue();
});

test('duplicated media', function () {
    $publicDisk = Storage::fake('public');
    $folder = 'test';
    $fileName = 'test.png';
    $filePath = $folder.'/'.$fileName;
    $publicDisk->put('media/'.$filePath, 'test');

    $response = $this->setUser()->post('/admin/media', [
        'file' => UploadedFile::fake()->image($fileName),
        'path' => $folder,
    ]);

    $response->assertRedirect('/admin/media');
    expect(session('errors')->getBag('default')->first())->toEqual('File already exists!');
});

test('delete media', function () {
    $publicDisk = Storage::fake('public');
    $filePath = 'test/test.png';
    $publicDisk->put('media/'.$filePath, 'test');

    $response = $this->setUser()->delete('/admin/media', [
        'path' => 'media/'.$filePath,
    ]);

    $response->assertRedirect('/admin/media');
    $response->assertSessionHas('success');
    expect($publicDisk->exists('media/'.$filePath))->toBeFalse();
});