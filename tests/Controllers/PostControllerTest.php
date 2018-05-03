<?php

namespace Tests\Feature\Controllers;

use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    private $mock;
    
    public function setUp()
    {
        parent::setUp();
    
        $this->mock = $this->mock('Post');
    }

    private function mock($class)
    {
        $mock = Mockery::mock('Eloquent', $class);
        $this->app->instance($class, $mock);
        return $mock;
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Index method test of controller
     *
     * @return void
     */
    public function testIndex()
    {
        $this->mock->shoulReceive('paginate')->with(5)->once();
        //$response = call('GET', 'posts-test');
        $response = $this->get('posts-test');
        $response->assertViewHas('posts');
    }
}
