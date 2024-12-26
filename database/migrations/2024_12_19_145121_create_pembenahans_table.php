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
        Schema::create('pembenahans', function (Blueprint $table) {
            $table->id();
            $table->string('tiketing')->unique();
            $table->string('nama_pelanggan');
            $table->enum('jenis_koneksi',['WIRELESS','HTB','FIBER OPTIC','LAN']);
            $table->string('keterangan');
            $table->date('downtime');
            $table->string('lokasi_pelanggan');
            $table->foreignId('teknisi_id')->nullable()->constrained('teknisis')->cascadeOnDelete('set null');
            $table->enum('status',['pending','in-progress','resolved','rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembenahans');
    }
};
