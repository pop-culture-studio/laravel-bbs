<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_successful()
    {
        $response = $this->post(route('post.store'), [
            'title' => 'test title',
            'content' => 'test content',
            'name' => 'test name',
            'email' => 'test@localhost',
            'password' => 'password',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('posts', 1)
             ->assertDatabaseHas('posts', [
                 'title' => 'test title',
                 'content' => 'test content',
                 'name' => 'test name',
                 'email' => 'test@localhost',
             ]);
    }

    public function test_store_invalid()
    {
        $response = $this->post(route('post.store'), [
            'title' => 'test title',
            'content' => '',
            'password' => 'password',
        ]);

        $response->assertRedirect()
                 ->assertInvalid(['content']);

        $this->assertDatabaseCount('posts', 0)
             ->assertDatabaseMissing('posts', [
                 'title' => 'test title',
             ]);
    }

    public function test_store_invalid_missing_password()
    {
        $response = $this->post(route('post.store'), [
            'content' => 'test',
            'password' => null,
        ]);

        $response->assertRedirect()
                 ->assertInvalid(['password']);

        $this->assertDatabaseCount('posts', 0)
             ->assertDatabaseMissing('posts', [
                 'content' => 'test',
             ]);
    }
}
