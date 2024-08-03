@extends('layouts.app')
@section('title', 'Product')

@section('content')

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Product</h1>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-md-6"> --}}
                <!--   Kitchen Sink -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data Product
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <button type="button" id="openAddModal" class="btn btn-primary">Add Product</button>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Create</th>
                                        <th>Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($products as $item)
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $item->kode }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>
                                                {{ $item->harga }}
                                            </td>
                                            <td>
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
                <div id="addProductModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Product</h5>
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
                                        <label for="add_harga">Harga</label>
                                        <input type="text" class="form-control" id="add_harga" name="harga" required>
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
                                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm">
                                    <input type="hidden" id="product_id" name="product_id">
                                    <div class="form-group">
                                        <label for="kode">Kode</label>
                                        <input type="text" class="form-control" id="kode" name="kode">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Telepon</label>
                                        <input type="text" class="form-control" id="harga" name="harga">
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
                $('#addProductModal').modal('show');
            });

            $('#addSaveBtn').click(function() {
                var kode = $('#add_kode').val();
                var nama = $('#add_nama').val();
                var harga = $('#add_harga').val();

                if (kode === "") {
                    alert("kode fields is required!");
                    return;
                } else if (nama === " ") {

                    alert("nama fields is required!");
                    return;
                } else if (harga === " ") {

                    alert("harga fields is required!");
                    return;
                }


                $.ajax({
                    url: '/product/add', // URL to add new product
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token
                        kode: kode,
                        nama: nama,
                        harga: harga
                    },
                    success: function(response) {
                        // Add new row to the table


                        $('#addForm')[0].reset();

                        $('#addProductModal').modal('hide');
                        alert(response.message);
                        window.location.href = "{{ route('Transaction') }}";
                    },
                    error: function(xhr) {
                        alert('Failed to add product. Please try again.');
                    }
                });
            });


            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id'); // Ambil ID dari data atribut tombol
                var row = $(this).closest('tr');
                var kode = row.find('td').eq(0).text().trim();
                var nama = row.find('td').eq(1).text().trim();
                var harga = row.find('td').eq(2).text().trim();

                // Isi form modal dengan data pelanggan
                $('#product_id').val(id);
                $('#kode').val(kode);
                $('#nama').val(nama);
                $('#harga').val(harga);

                // Tampilkan modal
                $('#editModal').modal('show');
            });

            $('#saveBtn').click(function() {
                var id = $('#product_id').val();
                var kode = $('#kode').val();
                var nama = $('#nama').val();
                var harga = $('#harga').val();

                $.ajax({
                    url: '/product/update/' + id, // URL untuk update product
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
                            window.location.href = "{{ route('DataProduct') }}";
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
                            alert('Failed to update product. Please try again.');
                        }
                    }
                });
            });




            // Delete button logic
            $(document).on('click', '.btn-delete', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');

                if (confirm('Are you sure you want to delete this product?')) {
                    $.ajax({
                        url: '/product/delete/' + id, // URL to delete product
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            row.remove();
                        },
                        error: function(xhr) {
                            alert('Failed to delete product. Please try again.');
                        }
                    });
                }
            });
        });
    </script>

@endsection
