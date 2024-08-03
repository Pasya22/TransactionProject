<?php

namespace App\Http\Controllers;

use App\Models\TransactionRetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataCustomer extends Controller
{
    public function DataCustomer()
    {
        $customer = TransactionRetail::getAllDesc('t_customer','id');
        return view('Customer.index', compact('customer'));
    }
    // CustomerController.php
    public function store(Request $request)
    {
        $validation = $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
        ]);

        $data = array_merge($validation, [
            'created_at' => now(),
        ]);

       
        // insert data

        if (TransactionRetail::AddData('t_customer', $data)) {
            return response()->json(['success' => true, 'message' => 'Successfully Add Customer New']);

        } else {
            return back()->withInput()->with('error', 'Failed to Add Data Customer');

        }

    }

    public function update(Request $request, $id)
    {
        // Validasi data request
        $validation = $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
        ]);

        // Temukan customer berdasarkan ID
        $customer = TransactionRetail::getDataById('t_customer', 'id', $id);
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found.'], 404);
        }

        // Update field yang divalidasi
        $customer->kode = $validation['kode'];
        $customer->nama = $validation['nama'];
        $customer->telp = $validation['telp'];
        $customer->updated_at = Carbon::now('Asia/Jakarta');

        // Simpan perubahan ke database
        $executeUpdate = TransactionRetail::UpdateData('t_customer', 'id', $id, (array) $customer);

        if ($executeUpdate) {
            return response()->json(['success' => true, 'message' => 'Successfully updated customer.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update customer.'], 500);
    }

    public function destroy($id)
    {
        $deleteData = TransactionRetail::DeleteData('t_customer', 'id', $id);
        if ($deleteData) {
            return response()->json(['success' => true, 'message' => 'Successfully delete customer.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete customer']);
        }

    }
}
