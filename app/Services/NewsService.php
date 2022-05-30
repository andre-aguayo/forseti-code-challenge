<?php

namespace App\Services;

use App\Models\News;

class NewsService implements NewsInterface
{
    public function importNews(): bool
    {
        return true;
    }

    public function getNewsInDatabaseWithPagination(): News
    {
        return News::paginate(30);
    }
}
