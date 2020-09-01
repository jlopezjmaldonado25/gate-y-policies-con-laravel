<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_see_all_the_posts()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($admin = $this->createAdmin());

        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        $response = $this->get('admin/posts');

        $response->assertStatus(200)
            ->assertViewIs('admin.posts.index')
            ->assertViewHas('posts', function ($posts) use ($post1, $post2) {
                return $posts->contains($post1) && $posts->contains($post2);
            });

        $this->assertNotRepeatedQueries();
    }

    /** @test */
    /* function authenticated_users_can_view_posts()
    {
        $this->withoutExceptionHandling();

        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        $this->actingAs($this->createUser());

        //$response = $this->get('posts');
        $response = $this->get('admin/posts');

        $response->assertStatus(200)
            ->assertViewIs('admin.posts.index')
            ->assertViewHas('posts', function ($posts) use ($post1, $post2) {
                return $posts->contains($post1) && $posts->contains($post2);
            });
    } */

    /** @test */
    function authors_can_only_see_their_posts()
    {
        $this->withoutExceptionHandling();

        $user = $this->createUser();

        $post1ByCurrentUser = factory(Post::class)->create(['user_id' => $user->id]);
        $post2ByAnotherUser = factory(Post::class)->create();
        $post3ByCurrentUser = factory(Post::class)->create(['user_id' => $user->id]);
        $post4ByAnotherUser = factory(Post::class)->create();

        $this->actingAs($user);

        $response = $this->get('admin/posts');

        /* $response->assertStatus(200)
            ->assertViewIs('admin.posts.index')
            ->assertViewHas('posts', function ($posts) use ($post1ByCurrentUser, $post2ByAnotherUser, $post3ByCurrentUser, $post4ByAnotherUser) {
                return $posts->contains($post1ByCurrentUser) && !$posts->contains($post2ByAnotherUser)
                    && $posts->contains($post3ByCurrentUser) && !$posts->contains($post4ByAnotherUser);
            }); */

        $response->assertStatus(200)
            ->assertViewIs('admin.posts.index');

        //$posts = $response->viewData('posts');

        $response->assertViewCollection('posts')
            ->contains($post1ByCurrentUser)
            ->contains($post3ByCurrentUser)
            ->notContains($post2ByAnotherUser)
            ->notContains($post4ByAnotherUser);
    }
}
