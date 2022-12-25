<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertSeeText('投稿はまだありません');
    }

    public function test_home_with_posts()
    {
        Post::factory()->count(20)->create();

        $response = $this->get('/');

        $response->assertStatus(200)
                 ->assertDontSeeText('投稿はまだありません')
                 ->assertViewHas('posts', fn ($posts) => $posts->total() === 20);

        $this->assertDatabaseCount('posts', 20);
    }
}
