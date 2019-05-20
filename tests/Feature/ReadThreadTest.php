<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadTest extends TestCase
{
    use RefreshDatabase; 

    protected $thread;

    public function setUp(): void 
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }    

    /** @test */
    function a_user_can_view_all_threads()
    {
        $this->get('/threads')

             ->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())

             ->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_associated_with_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())

             ->assertSee($reply->body); 
    }
 
   /** @test */
    function a_user_can_filter_threads_according_to_a_channel_tag()
    {
        $channel = create('App\Channel');

        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id ]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
             -> assertSee($threadInChannel->title)
             -> assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    function a_user_can_filter_threads_by_any_username()
    {
        // given we are signed in with a given username
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));
        // given we have a thread by JohnDoe and not by JohnDoe
        $threadByJon = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJon = create('App\Thread');
        // when we hit the URL with a query string
        $this->get('/threads?by=JohnDoe')
        // then we should see the thread by JohnDoe and not the other thread
             ->assertSee($threadByJon->title)
             ->assertDontSee($threadNotByJon->title);

    }
}
