<?php

namespace App\Console\Commands;

use App\Models\Content\Content;
use App\Models\Tweet\Tweet;
use App\UseCases\ContentService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CLearDataApplicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all data application';

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
     * @return mixed
     */
    public function handle()
    {
        $this->clearTweets();
        $this->clearContent();
    }

    protected function clearTweets(): void
    {
        DB::table('tweets')->truncate();

        $this->info('Tweets deleted');
    }

    protected function clearContent(): void
    {
        /** @var ContentService $contentService */
        $contentService = app()->make(ContentService::class);

        Content::all()->each(static function (Content $item) use ($contentService){
            $contentService->delete($item->id);
        });

        $this->info('Content deleted');
    }
}
