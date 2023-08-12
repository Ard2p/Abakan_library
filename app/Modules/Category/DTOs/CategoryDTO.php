<?php

namespace App\Modules\Category\DTOs;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CategoryDTO extends BaseDTO
{
    public function __construct(
        public readonly string        $name,
        public readonly string        $slug,
        public readonly ?int          $parent_id = null,
        public readonly ?UploadedFile $image = null
    )
    {
    }
}
