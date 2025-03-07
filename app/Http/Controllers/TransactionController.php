<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['mechanic', 'vehicle', 'cashier', 'sparePart', 'customer'])->get();
        return view('history.index', compact('transactions'));
    }


    public function create()
    {
        $mechanics = User::where('role', 'mechanic')->get();
        $vehicles = Vehicle::all();
        $cashiers = User::where('role', 'cashier')->get();
        $spareParts = SparePart::all();
        $customers = Customer::all();
        return view('transaction.create', compact('mechanics', 'vehicles', 'cashiers', 'spareParts', 'customers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mechanic_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'cashier_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id', 
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'description' => 'required|string',
            'spare_parts' => 'required|exists:spare_parts,id',
        ]);

        $sparePart = SparePart::find($validatedData['spare_parts']);
        $validatedData['grand_total'] = $validatedData['quantity'] * $sparePart->price;

        Transaction::create($validatedData);

        return redirect()->route('transaction.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $transaction->date = Carbon::parse($transaction->date)->format('Y-m-d');
        $mechanics = User::where('role', 'mechanic')->get();
        $vehicles = Vehicle::all();
        $cashiers = User::where('role', 'cashier')->get();
        $spareParts = SparePart::all();
        $customers = Customer::all();

        return view('transaction.edit', compact('transaction', 'mechanics', 'vehicles', 'cashiers', 'spareParts', 'customers'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'mechanic_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'cashier_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'description' => 'required|string',
            'spare_parts' => 'required|exists:spare_parts,id',
        ]);

        $sparePart = SparePart::find($validatedData['spare_parts']);
        $validatedData['grand_total'] = $validatedData['quantity'] * $sparePart->price;

        $transaction->update($validatedData);

        return redirect()->route('history.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('history.index')->with('success', 'Transaction deleted successfully.');
    }
}