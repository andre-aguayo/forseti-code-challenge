<?php

namespace App\Services;

use App\Models\News;
use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class NewsService implements NewsInterface
{

    private $errors = [];

    public function importNews(bool $verifySsl = true): array
    {
        for ($i = 0; $i < 5; $i++) {

            $offset = $i * 30; //identify page to import

            $response = Http::withOptions(["verify" => $verifySsl])
                ->get("https://www.gov.br/compras/pt-br/acesso-a-informacao/noticias?b_start:int=$offset");

            $html = $response->getBody()->getContents();

            $this->crawlAndStoreNews($html);
        }
        return $this->errors;
    }

    public function getNewsInDatabaseWithPagination(): News
    {
        return News::paginate(30);
    }

    private function crawlAndStoreNews(string $html)
    {
        $this->errors = [];

        ((new Crawler($html))->filter('article.tileItem'))->each(function (Crawler $node) {
            $linkTitle = $node->filter('a.summary'); //get news title

            $brlDateFormat = $node->filter('span.summary-view-icon')->text(); //get published date
            $usaFormatDate = $this->convertFormateDate($brlDateFormat); //convert date format

            try {
                News::create([
                    "title" => $linkTitle->text(),
                    "url" => $linkTitle->attr('href'),
                    "published_in" => $usaFormatDate
                ]);
            } catch (Exception $e) {
                //Define error message
                $message = $e->getCode() == 23000 ?  "URL already exists: $linkTitle->attr('href')" : $e->getMessage();

                array_push($this->errors, ["error_message" => $message, "error_code" => $e->getCode()]);
            }
        });
    }

    private function convertFormateDate(string $date): string
    {
        $arrayOfDate = explode('/', $date);

        return date("Y-m-d", strtotime("{$arrayOfDate[2]}-{$arrayOfDate[1]}-{$arrayOfDate[0]}"));
    }
}
