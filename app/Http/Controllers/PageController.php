<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Traits\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Page::latest()->get();
        return view('admin.page.index', compact('datas'));
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
        $data = $page;
        return view('admin.page.edit', compact('data'));
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
            if ($request->image){
                File::delete($page->image_url);
                $image_url = Support::storePageImage($request->image);
            }

            $page->update([
                'image_url' => $image_url,
                'order' => $request->order
            ]);
            return redirect()->route('page.index')->with('success', 'Page Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Error']);
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
            Page::truncate();
            return redirect()->route('page.index')->with('success', 'Barysy Pozuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
