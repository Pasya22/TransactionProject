<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TransactionRetail;

class DataProduct extends Controller
{
    public function DataProduct()
    {
        $products = TransactionRetail::getAllDesc('t_barang','id');
        return view('Product.index',compact('products'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'harga' => 'required|string|max:15',
        ]);

        $data = array_merge($validation, [
            'created_at' => now(),
        ]);


        // insert data

        if (TransactionRetail::AddData('t_barang', $data)) {
            return response()->json(['success' => true, 'message' => 'Successfully Add Product New']);

        } else {
            return back()->withInput()->with('error', 'Failed to Add Data Product');

        }

    }

    public function update(Request $request, $id)
    {
        // Validasi data request
        $validation = $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'harga' => 'required|string|max:15',
        ]);

        // Temukan product berdasarkan ID
        $barangs = TransactionRetail::getDataById('t_barang', 'id', $id);
        if (!$barangs) {
            return response()->json(['success' => false, 'message' => 'barangs not found.'], 404);
        }

        // Update field yang divalidasi
        $barangs->kode = $validation['kode'];
        $barangs->nama = $validation['nama'];
        $barangs->hasAttributeGetMutator = $validation['hasAttributeGetMutator'];
        $barangs->updated_at = Carbon::now('Asia/Jakarta');

        // Simpan perubahan ke database
        $executeUpdate = TransactionRetail::UpdateData('t_barang', 'id', $id, (array) $barangs);

        if ($executeUpdate) {
            return response()->json(['success' => true, 'message' => 'Successfully updated barangs.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update barangs.'], 500);
    }

    public function destroy($id)
    {
        $deleteData = TransactionRetail::DeleteData('t_barang', 'id', $id);
        if ($deleteData) {
            return response()->json(['success' => true, 'message' => 'Successfully delete barangs.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete barangs']);
        }

    }
}
