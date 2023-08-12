<?php

namespace App\Modules\MediaLibrary\Services;

use App\Modules\MediaLibrary\Enums\MediaLibraryCollection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;

interface MediaLibraryService
{
    /**
     * @param HasMedia $model
     * @param array<UploadedFile> $files
     * @param MediaLibraryCollection $collection
     * @return bool
     */
    public function addAllMedia(HasMedia $model, array|Collection $files, MediaLibraryCollection $collection): bool;

    public function deleteFileSelectively(HasMedia $model, array|Collection $payload, MediaLibraryCollection $collection): bool;
}
