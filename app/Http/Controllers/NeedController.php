<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;

class NeedController extends Controller
{
    public function index()
    {
        $needs = Need::all();
        return view('need.index', compact('needs'));
    }

    public function create()
    {
        return view('need.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required',
        ]);
        Need::create($request->all());
        return redirect()->route('need.index');
    }

    public function edit(Need $need)
    {
        $need = Need::findOrFail($need->id);
        return view('need.edit', compact('need'));

    }

    public function update(Request $request, Need $need)
    {
        $request->validate([
            'name_category' => 'required',
        ]);
        $need->update($request->all());
        return redirect()->route('need.index');
    }


    public function destroy(Need $need)
    {
        $need->delete();

        if(request()->header('Content-Type') === "application/json") {
            return response()->json($need);
        }
    }

}
