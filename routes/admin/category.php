<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Tbuy\User\Constants\Permission;
use Illuminate\Support\Facades\Route;

/** CATEGORY ROUTES */

Route::
    // middleware(['auth:sanctum'])->
    name('category.')
    ->prefix('category')
    ->group(function () {

        Route::get('', [CategoryController::class, 'index'])
            // ->middleware(Permission::VIEW_CATEGORY->toString())
            ->name('index');

        Route::post('', [CategoryController::class, 'store'])
            // ->middleware(Permission::STORE_CATEGORY->toString())
            ->name('store');

        Route::get('{category}', [CategoryController::class, 'show'])
            // ->middleware(Permission::SHOW_CATEGORY->toString())
            ->name('show');

        Route::put('{category}', [CategoryController::class, 'update'])
            // ->middleware(Permission::UPDATE_CATEGORY->toString())
            ->name('update');

        Route::delete('{category}', [CategoryController::class, 'destroy'])
            // ->middleware(Permission::DELETE_CATEGORY->toString())
            ->name('destroy');
    });
