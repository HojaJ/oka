<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function switch(Request $request)
    {
        Version::first()->update([
            'start_record' => $request->start_record === 'on'
        ]);
        return redirect()->back();
    }

    public function clear(Request $request)
    {
        Version::first()->update([
            'data' => null
        ]);
        return redirect()->back();

    }
}
