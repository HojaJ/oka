<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;
use App\Traits\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentless = Page::where('section_id', null)->get();
        $datas = Section::latest()->get();
        return view('admin.section.index', compact('datas', 'parentless'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Section::create([
                'name' => $request->name,
                'order' => $request->order
            ]);

            return redirect()->route('section.index')->with('success', 'Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $data = $section;
        return view('admin.section.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
            $section->update([
                'name' => $request->name,
                'order' => $request->order
            ]);
            return redirect()->route('section.index')->with('success', 'Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try{
            $section->delete();
            return redirect()->route('section.index')->with('success', 'Pozuldy');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function page_edit(Request $request, Section $section)
    {
        try {
            $min = (int)$request->min_number;
            $max = (int)$request->max_number;
            $pages = Page::whereBetween('id', [$min, $max])->get();
            $pages->each(function ($item) use($section){
                $item->update(['section_id'=> (int)$section->id]);
            });
            return redirect()->route('section.index')->with('success', 'Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }

    }


    public function bulk_add(Request $request)
    {
        try {
            $number = (int)$request->number;
            for ($i = 1; $i <= $number; $i++){
                Section::create([
                    'order' => $i
                ]);
            }

            return redirect()->route('section.index')->with('success', 'Section Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function bulk_remove(Request $request)
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Section::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect()->route('section.index')->with('success', 'Barysy Pozuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
