<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UsersController
 */
class UsersControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $users = Users::factory()->count(3)->create();

        $response = $this->get(route('user.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersController::class,
            'store',
            \App\Http\Requests\UsersStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $response = $this->post(route('user.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas(users, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $user = Users::factory()->create();

        $response = $this->get(route('user.show', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersController::class,
            'update',
            \App\Http\Requests\UsersUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $user = Users::factory()->create();

        $response = $this->put(route('user.update', $user));

        $user->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $user = Users::factory()->create();
        $user = User::factory()->create();

        $response = $this->delete(route('user.destroy', $user));

        $response->assertNoContent();

        $this->assertModelMissing($user);
    }
}
