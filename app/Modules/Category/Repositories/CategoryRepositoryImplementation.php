<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\DTOs\CategoryDTO;
use App\Modules\Category\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepositoryImplementation implements CategoryRepository
{
    public function get(): Collection
    {
        return Category::query()
            ->whereNull('parent_id')
            ->with(['image', 'grandChildren', 'parent'])
            ->get();
    }

    public function store(CategoryDTO $payload): Category
    {
        $category = new Category([
            'name'      => $payload->name,
            'slug'      => $payload->slug,
            'parent_id' => $payload->parent_id
        ]);
        $category->save();

        return $category;
    }

    public function update(Category $category, CategoryDTO $payload): Category
    {
        $category->fill([
            'name'      => $payload->name,
            'slug'      => $payload->slug,
            'parent_id' => $payload->parent_id
        ]);
        $category->save();

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
