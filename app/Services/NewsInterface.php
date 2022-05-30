<?php

namespace App\Services;

use App\Models\News;

interface NewsInterface
{
    /**
     * Description: Method used to create investment with name and balance
     * 
     * @param bool $verifySsl "Enable SSL verification?"
     */
    public function importNews(bool $verifySsl = true);


    /**
     * Description: Method used to list News with paginate
     *
     */
    public function getNewsInDatabaseWithPagination();
}
