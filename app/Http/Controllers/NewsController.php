<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsInterface;

class NewsController extends Controller
{
    public function __construct(private NewsInterface $news)
    {
    }

    public function requestNews()
    {
        $importNews = $this->news->importNews();

        if ($importNews === true)
            return response()->json(["success" => true, "jsonData" => []], 200);

        return response()->json(["success" => false, "jsonData" => $importNews], 400);
    }

    public function requestNewsWithoutVerification()
    {
        $importNews = $this->news->importNews(false);

        if ($importNews === true)
            return response()->json(["success" => true, "jsonData" => []], 200);

        return response()->json(["success" => false, "jsonData" => $importNews], 400);
    }

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
