@extends('layouts.app')
@section('title', 'Transaction')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">t_sales</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="#" id="transaction-form">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Transaksi</h3>
                                <div class="form-group">
                                    <label for="no">No:</label>
                                    <input type="text" class="form-control" id="no" name="no_transaction"
                                        value="{{ $no }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal:</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                                <h3>Customer</h3>
                                <div class="form-group">
                                    <label for="kode">Kode:</label>
                                    <input type="text" class="form-control" id="kode" name="kode" readonly>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#customerModal">Pilih Customer</button>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <input type="text" class="form-control" id="nama" name="nama" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telp:</label>
                                    <input type="text" class="form-control" id="telp" name="telp" readonly>
                                </div>
                                <input type="hidden" id="cust_id" name="cust_id">
                            </div>
                        </div>

                        <h3>Detail Barang</h3>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#barangModal">Tambah
                            Barang</button>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="150px">Aksi</th>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Bandrol</th>
                                            <th>Qty</th>
                                            <th>Diskon (%)</th>
                                            <th>Diskon (Nilai)</th>
                                            <th>Harga Diskon</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="barang-list">
                                        <!-- Barang list akan diisi melalui JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row2">
                            <div class="col-md-4 offset-md-8" id="finanly-total">
                                <div class="form-group">
                                    <label for="subtotal">Subtotal:</label>
                                    <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon:</label>
                                    <input type="number" class="form-control" id="diskon" name="diskon" value="0"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="ongkir">Ongkir:</label>
                                    <input type="number" class="form-control" id="ongkir" name="ongkir" value="0"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="total_bayar">Total Bayar:</label>
                                    <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-info">Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Customer Modal -->
        <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerModalLabel">Pilih Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select id="customerSelect" class="form-control" name="id">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" data-nama="{{ $customer->nama }}"
                                    data-telp="{{ $customer->telp }}">{{ $customer->kode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="selectCustomer()">Pilih</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="barangModalLabel">Pilih Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select id="barangSelect" class="form-control" id="id">
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" data-nama="{{ $barang->nama }}"
                                    data-harga="{{ $barang->harga }}">{{ $barang->kode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="selectBarang()">Pilih</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#transaction-form').on('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return;
                }

                // Serialize the form data
                let formData = $(this).serializeArray();

                // Convert formData to an object
                let data = {};
                formData.forEach(function(item) {
                    if (data[item.name]) {
                        if (!Array.isArray(data[item.name])) {
                            data[item.name] = [data[item.name]];
                        }
                        data[item.name].push(item.value);
                    } else {
                        data[item.name] = item.value;
                    }
                });

                console.log(data); // Log data yang dikirim untuk debugging

                $.ajax({
                    url: "{{ route('t_sales') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        alert('Transaction saved successfully.');
                        window.location.href = "{{ route('ListTransaction') }}";
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON); // Log response JSON untuk melihat error
                        alert(
                            'An error occurred while saving the transaction. Please try again.'
                        );
                    }
                });
            });

            function validateForm() {
                let isValid = true;

                // Validasi customer ID
                if ($('#cust_id').val() === '') {
                    isValid = false;
                    alert('Please select a customer.');
                }

                // Validasi barang
                if ($('#barang-list tr').length === 0) {
                    isValid = false;
                    alert('Please add at least one item.');
                }

                // Validasi subtotal, diskon, ongkir, dan total_bayar
                const validateField = (selector, message, minValue = 0) => {
                    const value = parseFloat($(selector).val());
                    if (isNaN(value) || value < minValue) {
                        isValid = false;
                        alert(message);
                    }
                };

                validateField('#subtotal', 'Please enter a valid subtotal.');
                validateField('#diskon', 'Please enter a valid discount.');
                validateField('#ongkir', 'Please enter a valid shipping cost.');
                validateField('#total_bayar', 'Please enter a valid total amount.');

                // Validasi field barang
                $('#barang-list tr').each(function() {
                    const validateRowField = (selector) => {
                        const value = $(selector).val();
                        if (value === '' || isNaN(parseFloat(value))) {
                            isValid = false;
                            alert('Please fill in all item details.');
                            return false;
                        }
                    };

                    validateRowField($(this).find('input[name^="barang"][name$="[id]"]'));
                    validateRowField($(this).find('input[name^="barang"][name$="[harga_bandrol]"]'));
                    validateRowField($(this).find('input[name^="barang"][name$="[qty]"]'));
                    validateRowField($(this).find('input[name^="barang"][name$="[diskon_pct]"]'));
                    validateRowField($(this).find('input[name^="barang"][name$="[diskon_nilai]"]'));
                    validateRowField($(this).find('input[name^="barang"][name$="[harga_diskon]"]'));
                    validateRowField($(this).find('input[name^="barang"][name$="[total]"]'));
                });

                return isValid;
            }

            $(document).on('input', 'input[name^="barang"]', function() {
                updateTotals();
            });

            function updateTotals() {
                let subtotal = 0;

                // Calculate subtotal from all items
                $('#barang-list tr').each(function() {
                    const total = parseFloat($(this).find('input[name^="barang"][name$="[total]"]')
                        .val()) || 0;
                    subtotal += total;
                });

                $('#subtotal').val(subtotal.toFixed(2));

                // Retrieve and calculate discount, shipping, and total bayar
                const diskon = parseFloat($('#diskon').val()) || 0;
                const ongkir = parseFloat($('#ongkir').val()) || 0;

                // Calculate total bayar
                const totalBayar = subtotal - diskon + ongkir;

                $('#total_bayar').val(totalBayar.toFixed(2));
            }


            // Update totals on input changes
            $(document).on('input',
                'input[name="barang[][qty]"], input[name="barang[0][diskon_pct]"], #diskon, #ongkir',
                function() {
                    updateTotals();
                });

            // Function to update item row values
            window.updateBarangRow = function(element) {
                const row = $(element).closest('tr');
                const qty = parseFloat(row.find('input[name="barang[0][qty]"]').val()) || 0;
                const hargaBandrol = parseFloat(row.find('input[name="barang[0][harga_bandrol]"]').val()) || 0;
                const diskonPct = parseFloat(row.find('input[name="barang[0][diskon_pct]"]').val()) || 0;

                const diskonNilai = (hargaBandrol * diskonPct / 100) * qty;
                const hargaDiskon = hargaBandrol - diskonNilai;
                const total = hargaDiskon * qty;

                row.find('input[name="barang[0][diskon_nilai]"]').val(diskonNilai.toFixed(2));
                row.find('input[name="barang[0][harga_diskon]"]').val(hargaDiskon.toFixed(2));
                row.find('input[name="barang[0][total]"]').val(total.toFixed(2));

                updateTotals();
            };


            window.selectCustomer = function() {
                const selectedOption = $('#customerSelect').find(':selected');
                const customerId = selectedOption.val();
                const customerNama = selectedOption.data('nama');
                const customerTelp = selectedOption.data('telp');

                $('#kode').val(selectedOption.text());
                $('#nama').val(customerNama);
                $('#telp').val(customerTelp);
                $('#cust_id').val(customerId);

                $('#customerModal').modal('hide');
            };

            // Define selectBarang function
            window.selectBarang = function() {
                const selectedOption = $('#barangSelect').find(':selected');
                const barangId = selectedOption.val();
                const barangNama = selectedOption.data('nama');
                const barangHarga = selectedOption.data('harga');

                addBarangToTable({
                    id: barangId,
                    kode: selectedOption.text(),
                    nama: barangNama,
                    harga_bandrol: barangHarga,
                    qty: 1,
                    diskon_pct: 0,
                    diskon_nilai: 0,
                    harga_diskon: barangHarga,
                    total: barangHarga
                });

                $('#barangModal').modal('hide');
            };


            // let barangIndex = 0;

            function addBarangToTable(barang) {
                const barangList = $('#barang-list');
                const row = `
            <tr>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeBarangFromTable(this)">Delete</button>
                    <button type="button" class="btn btn-warning" onclick="editBarangInTable(this)">Edit</button>
                </td>
                <td><input type="hidden" name="barang[0][id]" value="${barang.id}">${barang.id}</td>
                 
                <td>${barang.kode}</td>
                <td><input type="hidden" name="barang[0][nama]" value="${barang.nama}">${barang.nama}</td>
                <td><input type="hidden" name="barang[0][harga_bandrol]" value="${barang.harga_bandrol}">${barang.harga_bandrol}</td>
                <td><input type="number" name="barang[0][qty]" value="1" min="1" class="form-control" oninput="updateBarangRow(this)"></td>
                <td><input type="number" name="barang[0][diskon_pct]" value="0" min="0" max="100" class="form-control" oninput="updateBarangRow(this)"></td>
                <td><input type="number" name="barang[0][diskon_nilai]" value="0" class="form-control" readonly></td>
                <td><input type="number" name="barang[0][harga_diskon]" value="${barang.harga_bandrol}" class="form-control" readonly></td>
                <td><input type="number" name="barang[0][total]" value="${barang.harga_bandrol}" class="form-control" readonly></td>
            </tr>
        `;
                barangList.append(row);
                // barangIndex++;
                updateTotals();

            }

            window.removeBarangFromTable = function(button) {
                $(button).closest('tr').remove();
                updateTotals();
            };

            window.editBarangInTable = function(button) {
                const row = $(button).closest('tr');
                row.find('input').prop('readonly', false);
                $(button).text('Save').attr('onclick', 'saveBarangInTable(this)');
            }


            window.saveBarangInTable = function(button) {
                const row = $(button).closest('tr');

                // Update values for all inputs in the row
                updateBarangRow(row);

                // Set all inputs in the row to readonly
                row.find('input').prop('readonly', true);

                // Change the button text to 'Edit' and reset the onclick attribute
                $(button).text('Edit').attr('onclick', 'editBarangInTable(this)');
            }
            $('#transaction-form').on('reset', function() {
                barangIndex = 0;
                $('#barang-list').empty();
                $('#subtotal').val(0);
                $('#diskon').val(0);
                $('#ongkir').val(0);
                $('#total_bayar').val(0);
            });

            // function updateBarangRow(element) {
            //     const row = $(element).closest('tr');
            //     const qty = parseFloat(row.find('input[name="barang[][qty]"]').val()) || 0;
            //     const hargaBandrol = parseFloat(row.find('input[name="barang[][harga_bandrol]"]').val()) || 0;
            //     const diskonPct = parseFloat(row.find('input[name="barang[][diskon_pct]"]').val()) || 0;

            //     const diskonNilai = (hargaBandrol * diskonPct / 100) * qty;
            //     const hargaDiskon = hargaBandrol - diskonNilai;
            //     const total = hargaDiskon * qty;

            //     row.find('input[name="barang[][diskon_nilai]"]').val(diskonNilai.toFixed(2));
            //     row.find('input[name="barang[][harga_diskon]"]').val(hargaDiskon.toFixed(2));
            //     row.find('input[name="barang[][total]"]').val(total.toFixed(2));

            //     updateTotals();
            // }
        });
    </script>




@endsection
