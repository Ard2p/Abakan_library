<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

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
