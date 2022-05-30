<?php

namespace App\Services;

use App\Models\News;

interface NewsInterface
{
    public function importNews(): bool;

    public function getNewsInDatabaseWithPagination(): News;
}
