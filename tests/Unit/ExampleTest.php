<?php

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
    	//Given I have 2 records in the database that are posts.
    	//and each one is posted a month apart.
    	$first = factory(Post::class)->create();
    	$second = factory(Post::class)->create([
    		'created_at' => \Carbon\Carbon::now()->subMonth()
		]);
    	//When I fetch the archives
    	$posts = Post::archives();
    	//Then the response should be in the proper format.
    	$this->assertEquals([
    		[
    			"month" => $first->created_at->format('F'),
			    "year" => $first->created_at->format('Y'),
			    "published" => 1,
			    "sort" => $first->created_at->month
    		],	
    		[
    			"month" => $second->created_at->format('F'),
			    "year" => $second->created_at->format('Y'),
			    "published" => 1,
			    "sort" => $second->created_at->month
    		]
		], $posts);

        // $this->assertTrue(true);
    }
}
