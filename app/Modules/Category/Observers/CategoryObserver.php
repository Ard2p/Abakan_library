<?php

namespace App\Modules\Category\Observers;

use App\Modules\Category\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating(Category $category): void
    {
        $category->slug = Str::of($category->slug)->slug()->prepend('/');
    }

    public function updating(Category $category): void
    {
        $category->slug = Str::of($category->slug)->slug()->prepend('/');
    }

    public function deleting(Category $category): void
    {
        $category->children->each(fn(Category $category) => $category->delete());
    }
}
