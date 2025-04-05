<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Requirement;
use App\Models\Kasir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function index()
    {
        $expenses = Expenses::with('requirement.need')->latest()->paginate(5);

        $jumlahPesananCuci = Kasir::where('status', 'sedang_dicuci')->count();
        $jumlahPesananSelesai = Kasir::where('status', 'selesai')
                                ->whereDate('updated_at', Carbon::today())
                                ->count();
        $jumlahPelangganBulanIni = Kasir::whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->count();

                                        $pendapatan = Kasir::with('kasirService.service')
                                        ->latest()->paginate(5);
                                        // ->take(5)
                                        // ->get();
                                
                                    return view('Accounting.index', compact(
                                        'expenses',
                                        'jumlahPesananCuci',
                                        'jumlahPesananSelesai',
                                        'jumlahPelangganBulanIni',
                                        'pendapatan' 
                                    ));    }

    public function store($id)
{
    $requirement = Requirement::findOrFail($id);

    Expenses::create([
        'requirement_name' => $requirement->requirement_name,
        'stock' => $requirement->stock,
        'price' => $requirement->price,
        'category' => $requirement->need->name_category ?? '_',
        'grand_total' => $requirement->price * $requirement->stock,
        'date' => now(),
    ]);

    // Sekarang aman untuk menghapus
    $requirement->delete();

    return redirect()->route('accounting.index')->with('success', 'Data berhasil dipindahkan ke pengeluaran!');
}

    
}
