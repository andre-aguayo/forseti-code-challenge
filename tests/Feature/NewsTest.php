<?php

namespace Tests\Feature;

use App\Models\News;
use Exception;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_news()
    {
        $this->get('/import/without-verification');

        News::create(["title" => "title1", "url" => "htps://test.org", "published_in" => date("Y-m-d")]);
        $news1 = News::where("url", "=", "htps://test.org")->first();

        $this->assertTrue(empty($news1), "News is not created");
    }
}
