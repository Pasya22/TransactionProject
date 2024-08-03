<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionRetail extends Model
{
    use HasFactory;

    public static function getAll($table)
    {
        return DB::table($table)->get();
    }
    public static function getAllDesc($table,$fieldColumn)
    {
        return DB::table($table)->orderBy($fieldColumn, 'desc')->get();
    }
    public static function getId($table, $id)
    {
        return DB::table($table)->where($id)->get();
    }
    public static function getDataById($table, $fieldColumn, $id)
    {
        return DB::table($table)->where($fieldColumn, $id)->first();
    }

    public static function AddData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    public static function UpdateData($table, $key, $value, $data)
    {
        return DB::table($table)->where($key, $value)->update($data);
    }
    public static function DeleteData($table, $column, $value)
    {
        return DB::table($table)->where($column, $value)->delete();
    }

    public static function getTransactions($search = null)
    {
        $query = DB::table('t_sales')
            ->join('t_customer', 't_sales.cust_id', '=', 't_customer.id')
            ->leftJoin('t_sales_det', 't_sales.id', '=', 't_sales_det.sales_id')
            ->select(
                't_sales.id as transaction_id', // Nomor Transaksi
                't_sales_det.no_transaction as no_trx', // Nomor Transaksi
                't_sales.created_at as transaction_date',
                't_customer.nama as customer_name',
                DB::raw('SUM(t_sales_det.qty) as item_count'), // Menghitung jumlah barang
                't_sales.subtotal',
                't_sales.diskon',
                't_sales.ongkir',
                't_sales.total_bayar'
            )
            ->groupBy(
                't_sales.id',
                't_sales_det.no_transaction',
                't_sales.created_at',
                't_customer.nama',
                't_sales.subtotal',
                't_sales.diskon',
                't_sales.ongkir',
                't_sales.total_bayar'
            )
            ->orderBy('DESC');

        // Filter results if search term is provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('t_customer.nama', 'LIKE', "%{$search}%")
                    ->orWhere('t_sales.id', 'LIKE', "%{$search}%");
            });
        }

        $transactions = $query->get();

        // Calculate grand total
        $grandTotal = $transactions->sum('total_bayar');

        return ['transactions' => $transactions, 'grand_total' => $grandTotal];
    }
}
