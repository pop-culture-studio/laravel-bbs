<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
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
            'icon' => 'icon1',
            'name' => 'test name',
            'email' => 'test@localhost',
            'password' => 'password',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('posts', 1)
             ->assertDatabaseHas('posts', [
                 'title' => 'test title',
                 'content' => 'test content',
                 'icon' => 'icon1',
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

    public function test_delete_confirm()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.delete', $post));

        $response->assertSuccessful();
    }

    public function test_admin_can_delete_post_without_password()
    {
        $admin = User::factory()->create(['id' => 1]);
        $post = Post::factory()->create();

        $response = $this->actingAs($admin)->delete(route('post.destroy', $post), [
            'password' => null,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('posts', 0)
             ->assertDatabaseMissing('posts', [
                 'id' => $post->id,
             ]);
    }

    public function test_guest_can_delete_post_with_password()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('post.destroy', $post), [
            'password' => 'password',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('posts', 0)
             ->assertDatabaseMissing('posts', [
                 'id' => $post->id,
             ]);
    }

    public function test_guest_cannot_delete_post_without_password()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('post.destroy', $post), [
            'password' => null,
        ]);

        $response->assertRedirect()
                 ->assertInvalid(['password']);

        $this->assertDatabaseCount('posts', 1)
             ->assertDatabaseHas('posts', [
                 'id' => $post->id,
             ]);
    }
}
