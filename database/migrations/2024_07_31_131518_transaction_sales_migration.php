<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('t_customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode');
            $table->string('nama');
            $table->string('telp');
            $table->timestamps();
        });

        Schema::create('t_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode');
            $table->string('nama');
            $table->decimal('harga', 15, 2); // Menambahkan presisi dan skala untuk decimal
            $table->timestamps();
        });

        Schema::create('t_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cust_id'); // Mengubah tipe menjadi unsignedBigInteger untuk foreign key
            $table->decimal('subtotal', 15, 2); // Menambahkan presisi dan skala untuk decimal
            $table->decimal('diskon', 15, 2);
            $table->decimal('ongkir', 15, 2);
            $table->decimal('total_bayar', 15, 2);
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('cust_id')->references('id')->on('t_customer')->onDelete('cascade');
        });

        Schema::create('t_sales_det', function (Blueprint $table) {
            $table->bigIncrements('id'); // Mengubah nama kolom menjadi id untuk konsistensi
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('barang_id');
            $table->decimal('harga_bandrol', 15, 2);
            $table->integer('qty');
            $table->decimal('diskon_pct', 5, 2);
            $table->decimal('diskon_nilai', 15, 2);
            $table->decimal('harga_diskon', 15, 2);
            $table->decimal('total', 15, 2);
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('sales_id')->references('id')->on('t_sales')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('t_barang')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::table('t_sales_det', function (Blueprint $table) {
            $table->dropForeign(['sales_id']);
            $table->dropForeign(['barang_id']);
        });

        Schema::table('t_sales', function (Blueprint $table) {
            $table->dropForeign(['cust_id']);
        });

        Schema::dropIfExists('t_sales_det');
        Schema::dropIfExists('t_sales');
        Schema::dropIfExists('t_barang');
        Schema::dropIfExists('t_customer');
    }
};
