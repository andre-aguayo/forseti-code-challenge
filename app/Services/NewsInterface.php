<?php

namespace App\Services;

use App\Models\News;

interface NewsInterface
{
    public function importNews(bool $verifySsl = true): array;

    public function getNewsInDatabaseWithPagination();
}
