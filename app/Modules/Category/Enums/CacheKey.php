<?php

namespace App\Modules\Category\Enums;

enum CacheKey: string
{
    case CATEGORY_LIST = 'category-list';

    public static function ttl(): int
    {
        return 3600 * 24; // 24 hours
    }
}
