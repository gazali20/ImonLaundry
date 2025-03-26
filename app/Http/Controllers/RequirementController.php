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

public function edit(Requirement $requirement)
{
    $needs = Need::all();
    return view('requirement.edit', compact('needs', 'requirement'));
}

public function update(Request $request, Requirement $requirement)
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

    $requirement->update([
        'id_need' => $request->id_need,
        'requirement_name' => $request->requirement_name,
        'stock' => $request->stock,
        'price' => $request->price,
        'grand_total' => $grandTotal,
        'image' => $imageName,
    ]);

}

public function detail(Requirement $requirement)
{
    return view('requirement.detail', compact('requirement'));
}

public function destroy(Requirement $requirement)
{
    // Hapus gambar jika ada
    if ($requirement->image && file_exists(public_path('images/services/' . $requirement->image))) {
        unlink(public_path('images/services/' . $requirement->image));
    }

    $requirement->delete();

    if (request()->expectsJson()) {
        return response()->json(['message' => 'Kebutuhan berhasil dihapus.']);
    }

}

// public function saveToAccounting($id)
// {
//     // Ambil data requirement berdasarkan ID
//     $requirement = Requirement::findOrFail($id);

//     // Proses data untuk disimpan ke pengeluaran (contoh: simpan ke tabel lain atau update status)
//     // Misalnya, tambahkan data ke tabel pengeluaran
//     \DB::table('`expenses`')->insert([
//         'requirement_id' => $requirement->id,
//         'amount' => $requirement->price * $requirement->stock,
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//     // Redirect ke halaman Accounting.index dengan pesan sukses
//     return redirect()->route('accounting.index')->with('success', 'Data berhasil disimpan ke pengeluaran.');
// }

}
