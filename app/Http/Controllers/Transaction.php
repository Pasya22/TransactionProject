<?php

namespace App\Http\Controllers;

use App\Models\TransactionRetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaction extends Controller
{
    // public function Transaction()
    // {
    //    return view('Transaction.index');
    // }
    public function ListTransaction(Request $request)
    {
        $search = $request->input('search');
        $result = TransactionRetail::getTransactions($search);

        return view('transaction.ListTransaction', [
            'transactions' => $result['transactions'],
            'grand_total' => $result['grand_total']
        ]);
    }

    public function Transaction()
    {
        $date = Carbon::now()->format('Ymd'); // Get current date in YYYYMMDD format
        $transactionCount = DB::table('t_sales')->whereDate('created_at', Carbon::today())->count() + 1; // Get count of today's transactions and increment by 1
        $no = 'TRX-' . $date . '-' . str_pad($transactionCount, 3, '0', STR_PAD_LEFT); // Generate unique transaction number

        $customers = TransactionRetail::getAll('t_customer');
        $barangs = TransactionRetail::getAll('t_barang');

        return view('Transaction.index', compact('customers', 'barangs', 'no'));
    }
    public function getCustomerByKode($kode)
    {
        $customer = DB::table('t_customer')->where('kode', $kode)->first();
        return response()->json($customer);
    }

    public function getBarangById($id)
    {
        $barang = DB::table('t_barang')->where('kode', $id)->first();
        return response()->json($barang);
    }

    public function store(Request $request)
    {
        \Log::info('Received request data:', $request->all());

        $request->validate([
            'cust_id' => 'required|exists:t_customer,id',
            'subtotal' => 'required|numeric',
            'diskon' => 'required|numeric',
            'ongkir' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'barang' => 'required|array',
            'barang.*.id' => 'required|exists:t_barang,id',
            'barang.*.harga_bandrol' => 'required|numeric',
            'barang.*.qty' => 'required|numeric',
            'barang.*.diskon_pct' => 'required|numeric',
            'barang.*.diskon_nilai' => 'required|numeric',
            'barang.*.harga_diskon' => 'required|numeric',
            'barang.*.total' => 'required|numeric',
        ]);

        try {
            // Insert into t_sales table
            $salesId = DB::table('t_sales')->insertGetId([
                'cust_id' => $request->cust_id,
                'subtotal' => $request->subtotal,
                'diskon' => $request->diskon,
                'ongkir' => $request->ongkir,
                'total_bayar' => $request->total_bayar,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Prepare data for t_sales_det
            $salesDetails = [];
            foreach ($request->input('barang') as $barang) {
                $salesDetails[] = [
                    'sales_id' => $salesId,
                    'barang_id' => $barang['id'],
                    'harga_bandrol' => $barang['harga_bandrol'],
                    'qty' => $barang['qty'],
                    'diskon_pct' => $barang['diskon_pct'],
                    'diskon_nilai' => $barang['diskon_nilai'],
                    'harga_diskon' => $barang['harga_diskon'],
                    'total' => $barang['total'],
                    'no_transaction' => $request->no_transaction,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert into t_sales_det table
            DB::table('t_sales_det')->insert($salesDetails);

            return response()->json(['success' => 'Transaction saved successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error inserting transaction: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the transaction. Please try again.'], 500);
        }
    }

}
