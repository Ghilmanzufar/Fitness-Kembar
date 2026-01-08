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
            $table->string('phone')->unique(); 
            $table->date('join_date'); 
            $table->date('expiry_date')->nullable(); 
            $table->timestamps(); 
        });

        // 2. Tabel Transaksi (Keuangan)
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('cascade');
            $table->string('type'); // Tipe transaksi (string biasa)
            $table->decimal('amount', 15, 2); 
            $table->text('notes')->nullable(); 
            $table->timestamps(); 
        });

        // 3. Tabel Absensi (Logbook Digital)
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->timestamp('check_in_time'); 
            // Opsional: tambahkan timestamps() jika ingin track created_at/updated_at juga
            $table->timestamps(); 
        });

        // 4. Tabel Bagian Tubuh (Perbaikan: Tambah timestamps)
        Schema::create('body_parts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('image')->nullable();
            $table->timestamps(); // <--- BARIS INI KEMARIN HILANG
        });

        // 5. Tabel Latihan (Perbaikan: Tambah timestamps)
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('body_part_id')->constrained('body_parts')->onDelete('cascade');
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->string('video_url')->nullable(); 
            $table->timestamps(); // <--- BARIS INI KEMARIN HILANG
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