<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\Category;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::with('category')->get();
        return view('requirement.index', compact('requirements'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('requirement.create', compact('categories'));
    }

    public function store(Requeest $request) 
    {
        $request->validate ([
            'id_category' => 'required',
            'requirement_name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/services'), $imageName);
        }

        Requirement::create([
            'id_category' => $request->id_category,
            'requirement_name' => $request->requirement_name,
            'stock' => $request->stock,
            'price' => $request->price,
            'grand_total' => $request->grand_total,
            'image' => $imageName,
        ]);
        return redirect()->route('requirement.index');
    }
}
