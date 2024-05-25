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
        $sections = [
            1 => ['start_unit' => 1, 'start_paragraph' => 1, 'end_unit' => 2, 'end_paragraph' => 141],
            2 => ['start_unit' => 2, 'start_paragraph' => 142, 'end_unit' => 2, 'end_paragraph' => 252],
            3 => ['start_unit' => 2, 'start_paragraph' => 253, 'end_unit' => 3, 'end_paragraph' => 92],
            4 => ['start_unit' => 3, 'start_paragraph' => 93, 'end_unit' => 4, 'end_paragraph' => 23],
            5 => ['start_unit' => 4, 'start_paragraph' => 24, 'end_unit' => 4, 'end_paragraph' => 147],
            6 => ['start_unit' => 4, 'start_paragraph' => 148, 'end_unit' => 5, 'end_paragraph' => 81],
            7 => ['start_unit' => 5, 'start_paragraph' => 82, 'end_unit' => 6, 'end_paragraph' => 110],
            8 => ['start_unit' => 6, 'start_paragraph' => 111, 'end_unit' => 7, 'end_paragraph' => 87],
            9 => ['start_unit' => 7, 'start_paragraph' => 88, 'end_unit' => 8, 'end_paragraph' => 40],
            10 => ['start_unit' => 8, 'start_paragraph' => 41, 'end_unit' => 9, 'end_paragraph' => 92],
            11 => ['start_unit' => 9, 'start_paragraph' => 93, 'end_unit' => 11, 'end_paragraph' => 5],
            12 => ['start_unit' => 11, 'start_paragraph' => 6, 'end_unit' => 12, 'end_paragraph' => 52],
            13 => ['start_unit' => 12, 'start_paragraph' => 53, 'end_unit' => 14, 'end_paragraph' => 52],
            14 => ['start_unit' => 15, 'start_paragraph' => 1, 'end_unit' => 16, 'end_paragraph' => 128],
            15 => ['start_unit' => 17, 'start_paragraph' => 1, 'end_unit' => 18, 'end_paragraph' => 74],
            16 => ['start_unit' => 18, 'start_paragraph' => 75, 'end_unit' => 20, 'end_paragraph' => 135],
            17 => ['start_unit' => 21, 'start_paragraph' => 1, 'end_unit' => 22, 'end_paragraph' => 78],
            18 => ['start_unit' => 23, 'start_paragraph' => 1, 'end_unit' => 25, 'end_paragraph' => 20],
            19 => ['start_unit' => 25, 'start_paragraph' => 21, 'end_unit' => 27, 'end_paragraph' => 55],
            20 => ['start_unit' => 27, 'start_paragraph' => 56, 'end_unit' => 29, 'end_paragraph' => 45],
            21 => ['start_unit' => 29, 'start_paragraph' => 46, 'end_unit' => 33, 'end_paragraph' => 33],
            22 => ['start_unit' => 33, 'start_paragraph' => 31, 'end_unit' => 36, 'end_paragraph' => 27],
            23 => ['start_unit' => 36, 'start_paragraph' => 28, 'end_unit' => 39, 'end_paragraph' => 31],
            24 => ['start_unit' => 39, 'start_paragraph' => 32, 'end_unit' => 41, 'end_paragraph' => 46],
            25 => ['start_unit' => 41, 'start_paragraph' => 47, 'end_unit' => 45, 'end_paragraph' => 37],
            26 => ['start_unit' => 46, 'start_paragraph' => 1, 'end_unit' => 51, 'end_paragraph' => 30],
            27 => ['start_unit' => 51, 'start_paragraph' => 31, 'end_unit' => 57, 'end_paragraph' => 29],
            28 => ['start_unit' => 58, 'start_paragraph' => 1, 'end_unit' => 66, 'end_paragraph' => 12],
            29 => ['start_unit' => 67, 'start_paragraph' => 1, 'end_unit' => 77, 'end_paragraph' => 50],
            30 => ['start_unit' => 78, 'start_paragraph' => 1, 'end_unit' => 114, 'end_paragraph' => 6],
        ];

        foreach ($sections as $key => $section){
            Section::find($key)->update([
                'name' => 'Cuz ' . $key,
                'start_unit' => $section['start_unit'],
                'start_paragraph' => $section['start_paragraph'],
                'end_unit' => $section['end_unit'],
                'end_paragraph' => $section['end_paragraph'],
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
