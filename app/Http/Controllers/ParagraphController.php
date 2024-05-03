<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Paragraph;
use App\Models\Unit;
use App\Traits\Support;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ParagraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $id = (int)request()->unit_id;
        if (!$id) {
            return redirect()->route('unit.index');
        }
        $q = $request->search;
        $datas = Paragraph::orderBy('order')->where('unit_id', $id)
            ->where(function (Builder $subQuery) use ($q) {
                $subQuery->where('name', 'like', '%' . $q . '%')
                    ->orWhere('explanation', 'like', '%' . $q . '%')
                    ->orWhere('translation', 'like', '%' . $q . '%');
            })
            ->paginate(10)->appends(request()->input());
        return view('admin.paragraph.index', compact('datas'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $audio = null;
            if ($request->audio) {
                $audio = Support::storeFile($request->audio);
            }

            Paragraph::create([
                'name' => $request->name,
                'explanation' => $request->explanation,
                'translation' => $request->translation,
                'audio' => $audio,
                'order' => $request->order,
                'unit_id' => $request->unit_id
            ]);

            return redirect()->route('paragraph.index', ['unit_id'=> $request->unit_id])->with('success', 'Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Paragraph $paragraph
     * @return \Illuminate\Http\Response
     */
    public function show(Paragraph $paragraph)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Paragraph $paragraph
     * @return \Illuminate\Http\Response
     */
    public function edit(Paragraph $paragraph)
    {
//        $units = Unit::latest()->get();
        return view('admin.paragraph.edit', compact('paragraph'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Paragraph $paragraph
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paragraph $paragraph)
    {
        try {
            $audio = $paragraph->audio;
            if ($request->audio) {
                File::delete($paragraph->audio);
                $audio = Support::storeFile($request->audio);
            }

            $paragraph->update([
                'name' => $request->name,
                'explanation' => $request->explanation,
                'translation' => $request->translation,
                'audio' => $audio,
                'order' => $request->order,
            ]);
            return redirect()->route('paragraph.index', ['unit_id' => $paragraph->unit_id])->with('success', 'Üýtgedildi');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Paragraph $paragraph
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paragraph $paragraph)
    {
        try {
            $paragraph->delete();
            return redirect()->route('paragraph.index', ['unit_id' => $paragraph->unit_id])->with('success', 'Pozuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function page_edit(Request $request, Paragraph $paragraph)
    {
        try {
            $page_id = Page::where('id', $request->page_id)->first()->id;
            $paragraph->update(['page_id' => $page_id]);
            return redirect()->back()->with('success', 'Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
