<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\KasirService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
//Penjual berdasarkan Kategori
        $sales = KasirService::join('services', 'kasir_service.service_id', '=', 'services.id')
            ->join('categories', 'services.id_category', '=', 'categories.id')
            ->selectRaw('categories.name_category as category_name, COUNT(kasir_service.id) as total')
            ->groupBy('categories.name_category')
            ->pluck('total', 'category_name');



//Grafik Keuntungan
        $monthlyIncome = DB::table('kasir_service')
            ->selectRaw('MONTH(created_at) as month, SUM(subtotal) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthlyExpenses = DB::table('expenses')
            ->selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $income = [];
        $expense = [];
        for ($i = 1; $i <= 12; $i++) {
            $income[] = $monthlyIncome[$i] ?? 0;
            $expense[] = $monthlyExpenses[$i] ?? 0;
        }

        $filter = $request->get('filter', 'daily');
        switch ($filter) {
            case 'weekly':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;

            case 'monthly':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;

            case 'yearly':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;

            default: // daily
                $start = Carbon::now()->startOfDay();
                $end = Carbon::now()->endOfDay();
                break;
        }
        $totalPendapatan = DB::table('kasirs')
            ->whereBetween('created_at', [$start, $end])
            ->sum('grand_total');
  

//Top Pesanan
            $topPesananJasa = DB::table('kasir_service')
            ->join('services', 'kasir_service.service_id', '=', 'services.id')
            ->join('categories', 'services.id_category', '=', 'categories.id')
            ->select(
                'services.name_service as service_name', // diperbaiki dari 'name' ke 'name_service'
                'categories.name_category as category_name',
                DB::raw('COUNT(kasir_service.id) as order_count'),
                DB::raw('SUM(kasir_service.subtotal) as profit')
            )
            ->groupBy('services.id', 'categories.name_category', 'services.name_service')
            ->orderByDesc('order_count')
            ->limit(5)
            ->get();


//Top Customer
            $topCustomers = DB::table('kasirs')
            ->select(
                'customer',
                DB::raw('MAX(created_at) as last_order'),
                DB::raw('SUM(grand_total) as total_spent'),
                DB::raw('COUNT(*) as transaction_count')
            )
            ->whereYear('created_at', Carbon::now()->year) // Tahun ini
            ->groupBy('customer')
            ->orderByDesc('total_spent')
            ->limit(5)
            ->get();


//Total Pendapatan
            $totalPendapatan = DB::table('kasirs')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('grand_total');

            // Optional: Dapatkan pendapatan tahun sebelumnya untuk hitung pertumbuhan
            $pendapatanTahunLalu = DB::table('kasirs')
            ->whereYear('created_at', Carbon::now()->subYear()->year)
            ->sum('grand_total');

            // Hitung persentase naik/turun
            $persenPertumbuhan = 0;
            if ($pendapatanTahunLalu > 0) {
            $persenPertumbuhan = (($totalPendapatan - $pendapatanTahunLalu) / $pendapatanTahunLalu) * 100;
            }

//Total Pengeluaran
            $totalPengeluaran = DB::table('expenses')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('grand_total');

            $pengeluaranTahunLalu = DB::table('expenses')
            ->whereYear('created_at', Carbon::now()->subYear()->year)
            ->sum('grand_total');

            $pertumbuhanPengeluaran = 0;
            if ($pengeluaranTahunLalu > 0) {
            $pertumbuhanPengeluaran = (($totalPengeluaran - $pengeluaranTahunLalu) / $pengeluaranTahunLalu) * 100;
            }

//Total Peesanan
            $totalPencucian = DB::table('kasir_service')
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

            $pencucianTahunLalu = DB::table('kasir_service')
            ->whereYear('created_at', Carbon::now()->subYear()->year)
            ->count();

            $pertumbuhanPencucian = 0;
            if ($pencucianTahunLalu > 0) {
            $pertumbuhanPencucian = (($totalPencucian - $pencucianTahunLalu) / $pencucianTahunLalu) * 100;
            }

            return view('index', [
            'salesByCategory' => $sales,
            'incomeData' => $income,
            'expenseData' => $expense,
            'totalPendapatan' => $totalPendapatan,
            'topPesananJasa' => $topPesananJasa,
            'topCustomers' => $topCustomers,
            'persenPertumbuhan' => $persenPertumbuhan,
            'totalPengeluaran' => $totalPengeluaran,
            'pertumbuhanPengeluaran' => $pertumbuhanPengeluaran,
            'totalPencucian' => $totalPencucian,
            'pertumbuhanPencucian' => $pertumbuhanPencucian
            ]);

    }
}
