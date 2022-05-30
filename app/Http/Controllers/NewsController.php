<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsInterface;

class NewsController extends Controller
{
    public function __construct(private NewsInterface $news)
    {
    }

    /**
     * Description: Method used access a notices page with ssl verification
     * 
     */
    public function requestNews()
    {
        $this->news->importNews();

        return response()->json(["success" => true], 200);
    }

    /**
     * Description: Method used access a notices page without ssl verification
     * 
     */
    public function requestNewsWithoutVerification()
    {
        $this->news->importNews(false);

        return response()->json(["success" => true], 200);
    }

    /**
     * Description: Method used to list news with paginate
     * 
     */
    public function shwoListNews()
    {
        return response()->json([
            "success" => true,
            "jsonData" => [
                "news" => $this->news->getNewsInDatabaseWithPagination()
            ]
        ], 200);
    }
}
