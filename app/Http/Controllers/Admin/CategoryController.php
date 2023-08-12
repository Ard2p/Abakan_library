<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Modules\Category\Models\Category;
use App\Modules\Category\Requests\StoreRequest;
use App\Modules\Category\Requests\UpdateRequest;
use App\Modules\Category\Resources\CategoryResource;
use App\Modules\Category\Services\CategoryService;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Админ
 * @subgroup Категории
 * @authenticated
 */

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    /**
     * Получение списка категорий
     *
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        $category = $this->categoryService->get();

        return new SuccessResponse(
            response: CategoryResource::collection($category)
        );
    }

    /**
     * Создание категории
     *
     * @param StoreRequest $request
     * @return SuccessResponse
     */
    public function store(StoreRequest $request): SuccessResponse
    {
        $category = $this->categoryService->store($request->toDto());

        return new SuccessResponse(
            response: CategoryResource::make($category),
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Детали информация категории
     *
     * @urlParam category integer required ID категории. Example: 1
     * @param Category $category
     * @return SuccessResponse
     */
    public function show(Category $category): SuccessResponse
    {
        return new SuccessResponse(
            response: CategoryResource::make($category)
        );
    }

    /**
     * Обновление данных категории
     *
     * @urlParam category integer required ID категории. Example: 1
     * @bodyParam name string required Название категории. Example: Phone
     * @bodyParam slug string required Название категории. Example: phone
     * @bodyParam parent_id integer ID Название категории. Example: 1
     * @param UpdateRequest $request
     * @param Category $category
     * @return SuccessResponse
     */
    public function update(UpdateRequest $request, Category $category): SuccessResponse
    {
        $updateCategory = $this->categoryService->update($category, $request->toDto());

        return new SuccessResponse(
            response: CategoryResource::make($updateCategory)
        );
    }

    /**
     * Удаление категории
     *
     * @urlParam category integer required ID категории. Example: 1
     * @param Category $category
     * @return SuccessEmptyResponse
     */
    public function destroy(Category $category): SuccessEmptyResponse
    {
        $this->categoryService->delete($category);

        return new SuccessEmptyResponse();
    }

}
