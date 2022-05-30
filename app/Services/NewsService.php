<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class NewsService implements NewsInterface
{
    /**
     * Description: Method used to create investment with name and balance
     * 
     * @param bool $verifySsl "Enable SSL verification?"
     */
    public function importNews(bool $verifySsl = true)
    {
        for ($i = 0; $i < 5; $i++) {

            $offset = $i * 30; //identify page to import

            $response = Http::withOptions(["verify" => $verifySsl])
                ->get("https://www.gov.br/compras/pt-br/acesso-a-informacao/noticias?b_start:int=$offset");

            $html = $response->getBody()->getContents();

            $this->crawlAndStoreNews($html);
        }
    }

    /**
     * Description: Method used to list News with paginate
     *
     */
    public function getNewsInDatabaseWithPagination()
    {
        return News::paginate(30);
    }

    /**
     * Description: Method used to crawl HTML and stpre in News table
     * 
     * @param string $html "Request DOM"
     */
    private function crawlAndStoreNews(string $html)
    {
        ((new Crawler($html))->filter('article.tileItem'))->each(function (Crawler $node) {
            $linkTitle = $node->filter('a.summary'); //get news title

            $brlDateFormat = $node->filter('span.summary-view-icon')->text(); //get published date
            $usaFormatDate = $this->convertFormateDate($brlDateFormat); //convert date format

            $url = $linkTitle->attr('href');

            if (!$this->verifyNewsAlreadyExists($url))
                News::create([
                    "title" => $linkTitle->text(),
                    "url" => $url,
                    "published_in" => $usaFormatDate
                ]);
        });
    }


    /**
     * Description: Method used to verify if news already exists
     * 
     * @param string $url "Is url of news"
     * @return bool "News already exists?"
     */
    private function verifyNewsAlreadyExists(string $url): bool
    {
        $news = News::where("url", "=", $url)->first();

        return !empty($news);
    }

    /**
     * Description: Method used to convert date from 'd/m/Y' to 'Y-m-d'
     * 
     * @param string $date "Date it was sold"
     * @return string "Formatted date"
     */
    private function convertFormateDate(string $date): string
    {
        $arrayOfDate = explode('/', $date);

        return date("Y-m-d", strtotime("{$arrayOfDate[2]}-{$arrayOfDate[1]}-{$arrayOfDate[0]}"));
    }
}
