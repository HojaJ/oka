<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\Support;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $datas = Image::latest()->get();
        return view('admin.image.index', compact('datas'));
    }

    public function create(){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            if ($request->image){
                $image_url = Support::storeImage($request->image);
            }
            Image::create(['url' => $image_url]);

            return redirect()->route('image.index')->with('success', 'Image Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }


    public function edit(Image $image)
    {
        $data = $image;
        return view('admin.image.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Image $image)
    {
        try {
            if ($request->image){
                File::delete($image->url);
                $image_url = Support::storeImage($request->image);
            }
            $image->update(['url' => $image_url]);
            return redirect()->route('image.index')->with('success', 'Image Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Image $image)
    {
        try{
            File::delete($image->url);
            $image->delete();
            return redirect()->route('image.index')->with('success', 'Pozuldy');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
