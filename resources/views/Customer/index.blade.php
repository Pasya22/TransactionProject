@extends('layouts.app')
@section('title', 'Data Customer')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Customer</h1>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-md-6"> --}}
                <!--   Kitchen Sink -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data Customer
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <button type="button" id="openAddModal" class="btn btn-primary">Add Customer</button>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Name</th>
                                        <th>Telp</th>
                                        <th>Create</th>
                                        <th>Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($customer as $item)
                                    <tbody>
                                        <tr data-id="{{ $item->id }}">
                                            <td class="editable" data-field="kode">{{ $item->kode }}</td>
                                            <td class="editable" data-field="nama">{{ $item->nama }}</td>
                                            <td class="editable" data-field="telp">{{ $item->telp }}</td>
                                            <td class="editable" data-field="created_at">
                                                {{ $item->created_at }}
                                            </td>
                                            <td>
                                                {{ $item->updated_at }}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-delete"
                                                    data-id="{{ $item->id }}">Delete</a>
                                                <a href="#" class="btn btn-warning btn-edit"
                                                    data-id="{{ $item->id }}">Edit</a>
                                            </td>

                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End  Kitchen Sink -->
                <!-- Add Modal -->
                <div id="addCustomerModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addForm">
                                    <div class="form-group">
                                        <label for="add_kode">Kode</label>
                                        <input type="text" class="form-control" id="add_kode" name="kode" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_nama">Name</label>
                                        <input type="text" class="form-control" id="add_nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_telp">Telp</label>
                                        <input type="text" class="form-control" id="add_telp" name="telp" required>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="addSaveBtn">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- edit modal --}}

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm">
                                    <input type="hidden" id="customer_id" name="customer_id">
                                    <div class="form-group">
                                        <label for="kode">Kode</label>
                                        <input type="text" class="form-control" id="kode" name="kode">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Telepon</label>
                                        <input type="text" class="form-control" id="telp" name="telp">
                                    </div>
                                    <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- </div> --}}
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // Show Add Modal
            $('#openAddModal').click(function() {
                $('#addCustomerModal').modal('show');
            });

            $('#addSaveBtn').click(function() {
                var kode = $('#add_kode').val();
                var nama = $('#add_nama').val();
                var telp = $('#add_telp').val();

                if (kode === "") {
                    alert("kode fields is required!");
                    return;
                } else if (nama === " ") {

                    alert("nama fields is required!");
                    return;
                } else if (telp === " ") {

                    alert("telp fields is required!");
                    return;
                }


                $.ajax({
                    url: '/customer/add', // URL to add new customer
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token
                        kode: kode,
                        nama: nama,
                        telp: telp
                    },
                    success: function(response) {
                        // Add new row to the table


                        $('#addForm')[0].reset();

                        $('#addCustomerModal').modal('hide');
                        alert(response.message);
                        window.location.href = "{{ route('Transaction') }}";
                    },
                    error: function(xhr) {
                        alert('Failed to add customer. Please try again.');
                    }
                });
            });


            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id'); // Ambil ID dari data atribut tombol
                var row = $(this).closest('tr');
                var kode = row.find('td').eq(0).text().trim();
                var nama = row.find('td').eq(1).text().trim();
                var telp = row.find('td').eq(2).text().trim();

                // Isi form modal dengan data pelanggan
                $('#customer_id').val(id);
                $('#kode').val(kode);
                $('#nama').val(nama);
                $('#telp').val(telp);

                // Tampilkan modal
                $('#editModal').modal('show');
            });

            $('#saveBtn').click(function() {
                var id = $('#customer_id').val();
                var kode = $('#kode').val();
                var nama = $('#nama').val();
                var telp = $('#telp').val();

                $.ajax({
                    url: '/customer/update/' + id, // URL untuk update customer
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF
                        kode: kode,
                        nama: nama,
                        telp: telp
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update baris tabel dengan data baru
                            var row = $('tr[data-id="' + id + '"]');
                            row.find('td').eq(0).text(kode);
                            row.find('td').eq(1).text(nama);
                            row.find('td').eq(2).text(telp);

                            // Sembunyikan modal
                            $('#editModal').modal('hide');
                            alert(response.message);
                            window.location.href = "{{ route('DataCustomer') }}";
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON;
                        if (response.errors) {
                            var errors = response.errors;
                            var errorMessages = [];
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages.push(errors[key].join(' '));
                                }
                            }
                            alert('Validation errors: ' + errorMessages.join(' | '));
                        } else {
                            alert('Failed to update customer. Please try again.');
                        }
                    }
                });
            });




            // Delete button logic
            $(document).on('click', '.btn-delete', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');

                if (confirm('Are you sure you want to delete this customer?')) {
                    $.ajax({
                        url: '/customer/delete/' + id, // URL to delete customer
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            row.remove();
                        },
                        error: function(xhr) {
                            alert('Failed to delete customer. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
