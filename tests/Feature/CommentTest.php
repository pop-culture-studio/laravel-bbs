<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_with_comments()
    {
        Post::factory()->count(20)->hasComments(5)->create();

        $response = $this->get('/');

        $response->assertSuccessful()
                 ->assertDontSeeText('コメントはありません')
                 ->assertViewHas('posts', fn ($posts) => $posts->first()->comments()->count() === 5);

        $this->assertDatabaseCount('comments', 100);
    }

    public function test_store_successful()
    {
        $post = Post::factory()->create();

        $response = $this->post(route('post.comment.store', $post), [
            'content' => 'test content',
            'name' => 'test name',
            'email' => 'test@localhost',
            'password' => 'password',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseCount('comments', 1)
             ->assertDatabaseHas('comments', [
                 'post_id' => $post->id,
                 'content' => 'test content',
                 'name' => 'test name',
                 'email' => 'test@localhost',
             ]);
    }

    public function test_store_invalid()
    {
        $post = Post::factory()->create();

        $response = $this->post(route('post.comment.store', $post), [
            'content' => '',
            'password' => '',
        ]);

        $response->assertRedirect()
                 ->assertInvalid(['content', 'password']);

        $this->assertDatabaseCount('comments', 0)
             ->assertDatabaseMissing('comments', [
                 'content' => '',
             ]);
    }
}
