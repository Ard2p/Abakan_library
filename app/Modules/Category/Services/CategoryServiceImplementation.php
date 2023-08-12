<?php

namespace App\Modules\Category\Services;

use App\Modules\MediaLibrary\Enums\MediaLibraryCollection;
use App\Modules\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Modules\Category\DTOs\CategoryDTO;
use App\Modules\Category\Enums\CacheKey;
use App\Modules\Category\Models\Category;
use App\Modules\Category\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryServiceImplementation implements CategoryService
{
    public function __construct(
        private readonly MediaLibraryRepository $libraryRepository,
        private readonly CategoryRepository     $categoryRepository
    ) {
    }

    public function get(): Collection
    {
        return Cache::remember(
            CacheKey::CATEGORY_LIST->value,
            CacheKey::ttl(),
            fn () => $this->categoryRepository->get()
        );
    }

    public function store(CategoryDTO $payload): Category
    {
        $category = DB::transaction(function () use ($payload) {
            $category = $this->categoryRepository->store($payload);

            $this->libraryRepository->addMedia($category, $payload->image, MediaLibraryCollection::CATEGORY_IMAGE);

            return $category;
        });

        Cache::forget(CacheKey::CATEGORY_LIST->value);

        return $category;
    }

    public function update(Category $category, CategoryDTO $payload): Category
    {
        $category = DB::transaction(function () use ($category, $payload) {
            $category = $this->categoryRepository->update($category, $payload);

            if ($payload->image) {
                $this->libraryRepository->delete($category, MediaLibraryCollection::CATEGORY_IMAGE);
                $this->libraryRepository->addMedia($category, $payload->image, MediaLibraryCollection::CATEGORY_IMAGE);
            }

            return $category;
        });

        Cache::forget(CacheKey::CATEGORY_LIST->value);

        return $category;
    }

    public function delete(Category $category): void
    {
        DB::transaction(function () use ($category) {
            $this->categoryRepository->delete($category->load('children'));
        });

        Cache::forget(CacheKey::CATEGORY_LIST->value);
    }
}
