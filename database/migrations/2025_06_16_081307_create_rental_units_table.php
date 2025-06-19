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
        Schema::create('rental_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade');
            $table->enum('unit_mode', ['satuan', 'jumlah_banyak'])->default('satuan');
            $table->string('unit_code')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->enum('status', ['aktif', 'pause', 'mati'])->default('aktif');
            $table->text('note')->nullable();
            $table->foreignId('owner_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->integer('revenue_share')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_units');
    }
};
