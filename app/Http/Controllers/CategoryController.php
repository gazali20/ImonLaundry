<?php

namespace App\Http\Controllers;
use App\Models\category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    public function create()
    {
        return view('category.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('category.index');
    }
    public function edit(Category $category)
    {
        return view('category.create', compact('category'));

    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_category' => 'required',
        ]);
        $category->update($request->all());
        return redirect()->route('category.index');
    }
}
