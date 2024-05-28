<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Page;
use App\Models\Paragraph;
use App\Models\Section;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class UnitController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->search;
        $images = Image::latest()->get();
        $datas = Unit::oldest()
            ->where(function (Builder $subQuery) use ($q) {
                $subQuery->where('name', 'like', '%' . $q . '%')
                    ->orWhere('short_name', 'like', '%' . $q . '%');
            })
            ->paginate(20)->appends(request()->input());
        return view('admin.unit.index', compact('datas', 'images'));
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
            $paragraph_count = $request->paragraph_count;
            $unit = Unit::create([
                'name' => $request->name,
                'order' => $request->order,
                'section_id'=> 1,
                'short_name' => $request->short_name,
                'paragraph_count' => $paragraph_count,
                'image_id' => ($request->image_id === 'none' ? null : $request->image_id)
            ]);

            for ($i = 1; $i <= $paragraph_count; $i++) {
                Paragraph::create(['unit_id' => $unit->id, 'order' => $i]);
            }

            return redirect()->route('unit.index')->with('success', 'Goşuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $images = Image::latest()->get();
        $sections = Section::oldest()->get();
        $data = $unit;
        return view('admin.unit.edit', compact('data', 'images','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        try {
            $unit->update([
                'name' => $request->name,
                'section_id'=> 1,
                'order' => $request->order,
                'short_name' => $request->short_name,
                'paragraph_count' => $request->paragraph_count,
                'image_id' => ($request->image_id === 'none' ? null : $request->image_id)
            ]);
            return redirect()->route('unit.index')->with('success', 'Üýtgedildi');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            return redirect()->route('unit.index')->with('success', 'Pozuldy');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function page_edit(Request $request, Unit $unit)
    {
        try {
            $min = (int)$request->min_number;
            $max = (int)$request->max_number;
            $pages_id = Page::whereBetween('id', [$min, $max])->get()->pluck('id')->toArray();
            $unit->pages()->sync($pages_id);
            return redirect()->route('unit.index')->with('success', 'Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
