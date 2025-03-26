<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
{
    $services = Service::all();
    $categories = $services->pluck('category')->unique();

    return view('kasir.index', compact('services', 'categories'));
}

public function detail()
{
    return view('kasir.detail');
}

public function rincian()
{
    return view('kasir.rincian');
}

}
