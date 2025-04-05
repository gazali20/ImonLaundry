<?php

namespace App\Http\Controllers;
use App\Models\Kasir;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $kasirs = Kasir::with('services')->get();
        
        return view('Invoice.index', compact('kasirs'));
    }

    public function detail($id)
    {
        $kasir = Kasir::with('kasirService.service.category')->findOrFail($id);
        return view('Invoice.detail', compact('kasir'));

    }
}
