<?php

namespace Tests\Feature\Admin\Category;

use App\Modules\Category\Models\Category;
use App\Modules\User\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    public function test_successfully_get_list(): void
    {
        /** @var User $user */
        $user = User::query()->first();

        $this
            // ->actingAs($user)
            ->getJson(
                uri: route('api.category.index')
            )->assertOk()
            ->assertJsonStructure([
                'success',
                'data' => [
                    [
                        'id',
                        'name',
                        'slug',
                        'image',
                        'children'
                    ]
                ]
            ])
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );
    }

    public function test_successfully_create_new_category()
    {
        /** @var User $user */
        $user = User::query()->first();

        $categoryPayload = Category::factory()->raw([
            'image' => UploadedFile::fake()->image('category.png')
        ]);

        $this
            //    ->actingAs($user)
            ->postJson(
                uri: route('api.category.store'),
                data: $categoryPayload
            )
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'image'
                ]
            ])
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->where('data.name', $categoryPayload['name'])->etc()
            );
    }

    public function test_successfully_update()
    {
        /**
         * @var User $user
         * @var Category $category
         */
        $user = User::query()->first();

        $category = Category::query()->inRandomOrder()->first();

        $categoryPayload = Category::factory()->raw();

        $this
            // ->actingAs($user)
            ->putJson(
                uri: route('api.category.update', $category->id),
                data: $categoryPayload
            )
            ->assertOk()
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'image'
                ]
            ]);
    }

    public function test_fail_update_validation_without_body_parameters()
    {
        /**
         * @var User $user
         * @var Category $category
         */
        $user = User::query()->first();

        $category = Category::query()->inRandomOrder()->first();

        $categoryPayload = [];

        $this
            // ->actingAs($user)
            ->putJson(
                uri: route('api.category.update', $category->id),
                data: $categoryPayload
            )
            ->assertUnprocessable()
            ->assertJsonStructure([
                'errors' => [
                    'name',
                    'slug',
                ]
            ]);
    }

    public function test_successfully_delete()
    {
        /**
         * @var User $user
         * @var Category $category
         */
        $user = User::query()->first();
        $category = Category::query()->inRandomOrder()->first();

        $this
            // ->actingAs($user)
            ->deleteJson(
                uri: route('api.category.destroy', $category->id)

            )->assertOk()
            ->assertJsonStructure([
                'success'
            ])->assertJson(
                fn (AssertableJson $json) => $json
                    ->where('success', true)
                    ->etc()
            );

        $this->assertSoftDeleted('categories', [
            'id' => $category->id
        ]);
    }
}
