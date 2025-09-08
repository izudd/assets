<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('assets', function (Blueprint $table) {
        $table->id();
        $table->string('kode_aset')->unique();
        $table->string('kategori');
        $table->text('deskripsi')->nullable();
        $table->string('lokasi');
        $table->string('unit_pengguna');
        $table->integer('qty_sebelum')->default(0);
        $table->integer('qty_sesudah')->default(0);
        $table->integer('selisih')->default(0);
        $table->enum('kondisi', ['Baik','Rusak','Hilang','Tidak Ditemukan']);
        $table->text('catatan')->nullable();
        $table->string('dokumentasi')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
