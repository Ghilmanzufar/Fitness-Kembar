<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Member (Anggota Tetap)
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique(); // No HP jadi kunci utama (wajib unik)
            $table->date('join_date'); 
            $table->date('expiry_date')->nullable(); // Tanggal masa aktif habis
            $table->timestamps(); // Mencatat kapan dibuat/diedit
        });

        // 2. Tabel Transaksi (Keuangan)
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Member ID boleh kosong (NULL) jika transaksinya adalah "Harian" atau "Beli Minum Orang Lewat"
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('cascade');
            
            // Jenis transaksi sesuai request kamu
            $table->enum('type', [
                'registration', // Daftar Baru (135k)
                'renewal',      // Perpanjang (100k)
                'daily_visit',  // Harian (15k)
                'retail'        // Jual Air/Susu
            ]);
            
            $table->decimal('amount', 10, 2); // Jumlah uang
            $table->text('notes')->nullable(); // Catatan (misal: "Susu Kedelai 2 pcs")
            $table->timestamps(); // Otomatis mencatat tgl transaksi
        });

        // 3. Tabel Absensi (Logbook Digital)
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->timestamp('check_in_time'); // Jam datang
        });

        // 4. Tabel Bagian Tubuh (Untuk Panduan Latihan)
        Schema::create('body_parts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Dada, Punggung, Kaki, dll
            $table->string('image')->nullable();
        });

        // 5. Tabel Latihan (List Alat/Gerakan)
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('body_part_id')->constrained('body_parts')->onDelete('cascade');
            $table->string('name'); // Misal: Bench Press
            $table->text('description')->nullable(); // Cara pakai
            $table->string('video_url')->nullable(); // Link video/gif
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('body_parts');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('members');
    }
};