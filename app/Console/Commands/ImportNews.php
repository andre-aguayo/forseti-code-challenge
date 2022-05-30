<?php

namespace App\Console\Commands;

use App\Services\NewsService;
use Illuminate\Console\Command;

class ImportNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command used to import news every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment("Importins news... ");

        $newService = new NewsService();
        $newService->importNews(false);

        $this->info("Import succefull.");
        return 1;
    }
}
