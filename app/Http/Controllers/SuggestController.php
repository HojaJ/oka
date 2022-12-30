<?php

namespace App\Http\Controllers;

use App\Models\Suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestController extends Controller
{
    public function index()
    {
        $datas = Suggest::latest()->get();
        return view('admin.suggest.index', compact('datas'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Suggest $suggest)
    {
        //
    }


    public function edit(Suggest $suggest)
    {
        //
    }


    public function update(Request $request, Suggest $suggest)
    {
        //
    }


    public function destroy(Suggest $suggest)
    {
        try{
            $suggest->delete();
            Auth::user()->notifications()->where('type', 'App\Notifications\SuggestNotification')
                ->where('data->suggest_id', $suggest->id)->delete();

            return redirect()->route('suggest.index')->with('success', 'Pozuldy.');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
