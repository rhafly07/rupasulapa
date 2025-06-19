<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            // Detail pelanggan
            $table->string('name'); // Wajib
            $table->string('phone'); // Wajib

            // Alamat Pengiriman
            $table->string('region')->nullable(); // Kota / Kecamatan
            $table->text('full_address'); // Wajib
            $table->string('address_label')->nullable(); // Rumah, Kantor, dll.
            $table->string('recipient_name')->nullable(); // auto copy dari name
            $table->string('recipient_phone')->nullable(); // auto copy dari phone
            $table->string('postal_code')->nullable();
            $table->string('maps_link')->nullable(); // Link Google Maps

            // Akun Sosial
            $table->string('email')->nullable()->unique();
            $table->string('instagram_id')->nullable();
            $table->string('facebook_name')->nullable();

            // Kontak Darurat
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();

            // Rekening
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_name')->nullable();

            // Lain-lain
            $table->text('note')->nullable();
            $table->enum('type', ['penyewa', 'pemilik_unit'])->default('penyewa');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
