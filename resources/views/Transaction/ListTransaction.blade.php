@extends('layouts.app')
@section('title', 'Data Customer')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">List Transaksi</h1>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-md-6"> --}}
                <!--   Kitchen Sink -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Transaksi
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            {{-- <h1>Daftar Transaksi</h1> --}}

                            <!-- Search Form -->
                            <form method="GET" action="#">
                                <div class="form-group">
                                    <label for="search">Search:</label>
                                    <input type="text" id="search" name="search" class="form-control"
                                        value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Nama Customer</th>
                                        <th>Jumlah Barang</th>
                                        <th>Subtotal</th>
                                        <th>Diskon</th>
                                        <th>Ongkir</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->no_trx }}</td>
                                            <td>{{ $transaction->transaction_date }}</td>
                                            <td>{{ $transaction->customer_name }}</td>
                                            <td>{{ $transaction->item_count }}</td>
                                            <td>{{ number_format($transaction->subtotal, 2) }}</td>
                                            <td>{{ number_format($transaction->diskon, 2) }}</td>
                                            <td>{{ number_format($transaction->ongkir, 2) }}</td>
                                            <td>{{ number_format($transaction->total_bayar, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Grand Total -->
                            <div class="grand-total">
                                <h4>Grand Total: {{ number_format($grand_total, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End  Kitchen Sink -->



                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
