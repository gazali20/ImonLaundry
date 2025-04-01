<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Requirement;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::with('requirement.need')->latest()->get();
        return view('Accounting.index', compact('expenses'));
    }

    public function store($id)
    {
        $requirement = Requirement::findOrFail($id);
    
        Expenses::create([
            'id_requirement' => $requirement->id,
            'date' => now(),
            'grand_total' => $requirement->grand_total,
        ]);
    
        return redirect()->route('accounting.index')->with('success', 'Data berhasil disimpan ke pengeluaran!');
    }
    
}
