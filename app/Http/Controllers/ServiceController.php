<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category; 

class ServiceController extends Controller
{
    
    public function index()
    {
        $services = Service::with('category')->get(); 
        return view('services.index', compact('services'));
    }

  
    public function create()
    {
        $categories = Category::all(); 
        return view('services.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'id_category' => 'required|integer',
            'name_service' => 'required|string|max:255',
            'price' => 'required|numeric',
            'code' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/services'), $imageName);
        }

        Service::create([
            'id_category' => $request->id_category,
            'name_service' => $request->name_service,
            'price' => $request->price,
            'code' => $request->code,
            'image' => $imageName,
        ]);

        return redirect()->route('services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all();
        return view('services.edit', compact('service', 'categories'));
    }

    // Simpan perubahan layanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_category' => 'required|integer',
            'name_service' => 'required|string|max:255',
            'price' => 'required|numeric',
            'code' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $imageName = $service->image;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/services'), $imageName);
        }

        $service->update([
            'id_category' => $request->id_category,
            'name_service' => $request->name_service,
            'price' => $request->price,
            'code' => $request->code,
            'image' => $imageName,
        ]);

        return redirect()->route('services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function detail($id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all();
        return view('services.detail', compact('service', 'categories'));
    }

//     public function show($id)
// {
//     $service = Service::with('category')->findOrFail($id);
//                 return view('services.detail', compact('service'));
// }


    // Hapus layanan
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && file_exists(public_path('images/services/'.$service->image))) {
            unlink(public_path('images/services/'.$service->image));
        }

        $service->delete();

        if(request()->header('Content-Type') === "application/json") {
            return response()->json($services);
        }
    }
}
