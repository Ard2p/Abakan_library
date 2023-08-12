<?php

namespace App\Modules\Category\Services;

use App\Modules\Category\DTOs\CategoryDTO;
use App\Modules\Category\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryService
{
    public function get(): Collection;

    public function store(CategoryDTO $payload): Category;

    public function update(Category $category, CategoryDTO $payload): Category;

    public function delete(Category $category): void;
}
