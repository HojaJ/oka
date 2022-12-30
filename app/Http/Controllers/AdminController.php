<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $datas = User::latest()->get();
        return view('admin.admin.index', compact('datas'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {

        try {
            User::create([
               'name'  => $request->name,
               'password' => Hash::make($request->password)
            ]);

            return redirect()->route('admin_user.index')->with('success', 'Admin User Added');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = User::find($id);
            $data->update([
                'name'  => $request->name,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('admin_user.index')->with('success', 'Admin User Edited');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.admin.edit', compact('data'));
    }

    public function destroy($id)
    {
        try{
            $data = User::find($id);

            $data->delete();

            return redirect()->route('admin_user.index')->with('success', 'Pozuldy.');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
