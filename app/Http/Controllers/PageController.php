<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;
use App\Models\Unit;
use App\Traits\Support;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->search;
        $units = Unit::select('id','order','short_name')->get();
        $datas = Page::orderBy('order')
            ->where(function (Builder $subQuery) use ($q) {
                $subQuery->where('section_id', 'like', '%' . $q . '%');
            })
            ->paginate(30)->appends(request()->input());
        return view('admin.page.index', compact('datas','units'));
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
        $image_url= null;
        try {
            if ($request->image){
                $image_url = Support::storePageImage($request->image);
            }
            Page::create([
                'image_url' => $image_url,
                'order' => $request->order
            ]);

            return redirect()->route('page.index')->with('success', 'Page Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $sections = Section::select('id')->get();
        $data = $page;
        return view('admin.page.edit', compact('data','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        try {
            $image_url= null;
            if ($request->image){
                File::delete($page->image_url);
                $image_url = Support::storePageImage($request->image);
            }

            $page->update([
                'image_url' => $image_url,
                'section_id' => $request->section_id,
                'order' => $request->order
            ]);

            return redirect()->route('page.index')->with('success', 'Page Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function update_(Request $request, Page $page)
    {
        try {
            if($request->start_unit && $request->start_paragraph){
                $page->update([
                    'start_unit' => (int) $request->start_unit,
                    'start_paragraph' => (int) $request->start_paragraph
                ]);
            }

            if($request->end_unit && $request->end_paragraph){
                $page->update([
                    'end_unit' => (int) $request->end_unit,
                    'end_paragraph' => (int) $request->end_paragraph
                ]);
            }
            return redirect()->back()->with('success', 'Page Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function page_edit(Request $request, Page $page)
    {
        try {
            if ($request->image){
                File::delete($page->image_url);
                $image_url = Support::storePageImage($request->image);
            }
            $page->update(['image_url' => $image_url,]);
            return redirect()->route('page.index')->with('success', 'Image Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Error']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        try{
            File::delete($page->image_url);
            $page->delete();
            return redirect()->route('page.index')->with('success', 'Pozuldy');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function bulk_add(Request $request)
    {
        try {
            $number = (int)$request->number;
            for ($i = 1; $i <= $number; $i++){
                Page::create([
                    'order' => $i
                ]);
            }

            return redirect()->route('page.index')->with('success', 'Pagelar Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function bulk_remove(Request $request)
    {
        try {
            DB::statement("SET foreign_key_checks=0");
            Page::truncate();
            DB::statement("SET foreign_key_checks=1");
            return redirect()->route('page.index')->with('success', 'Barysy Pozuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
