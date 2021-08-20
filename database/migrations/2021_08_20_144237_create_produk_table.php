<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suplier_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->integer('stok')->default(0);
            $table->integer('harga')->default(0);
            $table->integer('markup')->default(0);
            $table->integer('markup_persen')->default(0);
            $table->integer('aktif')->default(1);
            $table->timestamps();

            $table->foreign('suplier_id')->on('suplier')->references('id')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->foreign('kategori_id')->on('kategori')->references('id')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->foreign('satuan_id')->on('satuan')->references('id')->onUpdate('SET NULL')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
