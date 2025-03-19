<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\Need;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::with('need')->get();
        return view('requirement.index', compact('requirements'));
    }

    public function create()
    {
        $needs = Need::all();
        return view('requirement.create', compact('needs'));
    }

    public function store(Request $request) 
{
    $request->validate([
        'id_need' => 'required',
        'requirement_name' => 'required|string|max:255',
        'stock' => 'required|integer',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/services'), $imageName);
    }

    $grandTotal = $request->stock * $request->price;

    Requirement::create([
        'id_need' => $request->id_need,
        'requirement_name' => $request->requirement_name,
        'stock' => $request->stock,
        'price' => $request->price,
        'grand_total' => $grandTotal,
        'image' => $imageName,
    ]);

    return redirect()->route('requirement.index');
}

}
