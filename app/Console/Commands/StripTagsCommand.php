<?php

namespace App\Console\Commands;

use App\Models\Paragraph;
use Illuminate\Console\Command;

class StripTagsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't:t';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $paragraphs = Paragraph::get();
        foreach ($paragraphs as $paragraph){
            $paragraph->update([
               'explanation' => strip_tags($paragraph->explanation),
               'translation' => strip_tags($paragraph->etranslationxplanation),
            ]);
        }
        return true;
    }
}
