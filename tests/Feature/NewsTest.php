<?php

namespace Tests\Feature;

use App\Models\News;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_news()
    {
        News::create(["title" => "title1", "url" => "htps://test.org", "published_in" => date("Y-m-d")]);
        $news1 = News::where("url", "=", "htps://test.org")->first();

        $this->assertTrue(empty($news1), "News is not created");
    }
}
