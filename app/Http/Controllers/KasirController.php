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
        return view('kasir.index', compact('kasirs', 'services'));
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
            $codeInvoice = 'INV-' . strtoupper(Str::random(8));

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

            // Log::info('Data kasir:', $kasir->toArray());

            // Tambahkan log untuk memeriksa data yang dikirim ke sync()
            // Log::info('Data yang dikirim ke sync:', $data);

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

    // Menampilkan detail transaksi
    public function show()
    {
        $kasir = Kasir::with('kasirService.service.category')->get();
        return view('kasir.detail', compact('kasir'));
    }
    
    public function rincian($id)
    {
        $kasir = Kasir::with('kasirService.service.category')->find($id);
        
        return view('kasir.rincian', compact('kasir'));
    }
    

    // Mengubah status transaksi
    public function updateStatus(Request $request, Kasir $kasir)
    {
        $request->validate([
            'status' => 'required|in:sedang_dicuci,siap_diambil,selesai',
        ]);

        $kasir->update(['status' => $request->status]);

        return back()->with('success', 'Status transaksi diperbarui.');
    }
}
