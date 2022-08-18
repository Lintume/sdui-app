<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_read_all_the_news()
    {
        //Given we have news in the database
        $news = News::factory()->create();
        $this->actingAs(User::factory()->create());

        //When user visit the news page
        $response = $this->get('/news');

        //He should be able to read the news
        $response->assertSee($news->title);
    }

    /** @test */
    public function a_user_can_read_single_news()
    {
        //Given we have news in the database
        $news = News::factory()->create();
        $this->actingAs(User::factory()->create());

        //When user visit the new's URI
        $response = $this->get('/news/' . $news->id);

        //He can see the news details
        $response->assertSee($news->title)
            ->assertSee($news->content);
    }

    /** @test */
    public function authenticated_users_can_create_a_new_news()
    {
        //Given we have an authenticated user
        $this->actingAs(User::factory()->create());
        $news = News::factory()->create();

        //When user submits post request to create news endpoint
        $response = $this->post('/news', $news->toArray());

        //He can see created news details
        $response->assertSee($news->title)
            ->assertSee($news->content);
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_news()
    {
        //Given we have the news object
        $news = News::factory()->create();

        //When unauthenticated user submits post request to create news endpoint
        // He should be redirected to login page
        $this->post('/news', $news->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    public function authorized_user_can_update_the_news()
    {
        //Given we have a signed in user
        $this->actingAs(User::factory()->create());

        //And a news which is created by the user
        $news = News::factory()->create(['user_id' => Auth::id()]);
        $news->title = "Updated Title";

        //When the user hit's the endpoint to update the news
        $this->put('/news/' . $news->id, $news->toArray());

        //The news should be updated in the database.
        $this->assertDatabaseHas('news', ['id' => $news->id, 'title' => 'Updated Title']);
    }

    /** @test */
    public function authorized_user_can_delete_the_news()
    {
        //Given we have a signed in user
        $this->actingAs(User::factory()->create());

        //And a news which is created by the user
        $news = News::factory()->create(['user_id' => Auth::id()]);

        //When the user hit's the endpoint to delete the news
        $this->delete('/news/' . $news->id);

        //The news should be deleted from the database.
        $this->assertDatabaseMissing('news', ['id' => $news->id]);
    }
}
