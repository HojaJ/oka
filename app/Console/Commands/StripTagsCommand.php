<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Section;
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
//        $pages = Page::get();
        $sections = Section::get();
        foreach ($sections as $section){
            $section->update([
               'name' => 'Section ' . $section->order
            ]);
        }
//        foreach ($pages as $page){
//            foreach ($sections as $section){
//                if(($section['min'] <= $page->id) && ($page->id <= $section['max'])){
//                    $page->update([
//                       'section_id' => $section['id']
//                    ]);
//                }
//            }
//        }
        return true;
    }
}
