<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\Requirement;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function index()
    {
        $needs = Need::all();
        $requirements = Requirement::all();
        return view('Accounting.index', compact('needs', 'requirements'));
    }
}
