<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasir;
use App\Models\Service;
use App\Models\KasirService;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class KasirController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
{
    $kasirs = Kasir::all();
    $services = Service::all();

    $dicuci = Kasir::where('status', 'sedang_dicuci')->get();
    $siap = Kasir::where('status', 'siap_diambil')->get();
    $selesai = Kasir::where('status', 'selesai')->get();

    return view('kasir.index', compact('kasirs', 'services', 'dicuci', 'siap', 'selesai'));
}


    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required|string|max:255',
            'no_handphone' => 'required|string|max:15',
            'payment' => 'required|string|in:cash,debit',
            'grand_total' => 'required|numeric|min:0',
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:services,id',
            'cart.*.weight' => 'required|numeric|min:0.1',
            'cart.*.price' => 'required|numeric|min:0',
        ]);

        try {
            $codeInvoice = 'INV-' . mt_rand(1000000, 99999999);

            $kasir = Kasir::create([
                'customer' => $request->customer,
                'no_handphone' => $request->no_handphone,
                'payment' => $request->payment,
                'grand_total' => $request->grand_total,
                'code_invoice' => $codeInvoice,
                'date' => now()->toDateString(),
            ]);

            if (!$kasir) {
                return response()->json(['message' => 'Gagal menyimpan transaksi.'], 500);
            }

            $data = [];
            foreach ($request->cart as $item) {
                $data[$item['id']] = [
                    'weight' => $item['weight'],
                    'subtotal' => $item['price'] * $item['weight'],
                ];
            }


            // Sinkronisasi data ke tabel pivot
            $kasir->services()->sync($data);

            return response()->json([
                'message' => 'Transaksi berhasil disimpan.',
                'id' => $kasir->id,
                'code_invoice' => $kasir->code_invoice, // Pastikan ini benar
            ]);            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan transaksi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show()
    {
        // Ambil semua transaksi
        $kasirs = Kasir::with('kasirService.service.category')->get();
    
        // Kosongkan koleksi
        $dicuci = collect();
        $siap = collect();
        $selesai = collect();
    
        // Loop satu per satu dan masukkan ke kategori pertama yang cocok
        foreach ($kasirs as $kasir) {
            if ($kasir->status === 'selesai') {
                $selesai->push($kasir);
            } elseif ($kasir->status === 'siap_diambil' && !$selesai->contains('id', $kasir->id)) {
                $siap->push($kasir);
            } elseif ($kasir->status === 'sedang_dicuci' && !$selesai->contains('id', $kasir->id) && !$siap->contains('id', $kasir->id)) {
                $dicuci->push($kasir);
            }
        }
    
        return view('kasir.detail', compact('dicuci', 'siap', 'selesai'));
    }
    
public function rincian($id)
{
    $kasir = Kasir::with('kasirService.service.category')->find($id);

    if (!$kasir) {
        return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
    }

    return view('kasir.rincian', compact('kasir'));
}
    
    

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:sedang_dicuci,siap_diambil,selesai',
    ]);

    $kasir = Kasir::findOrFail($id); // 100% hanya update data yang ada
    $kasir->status = $request->status;
    $kasir->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}  
}
