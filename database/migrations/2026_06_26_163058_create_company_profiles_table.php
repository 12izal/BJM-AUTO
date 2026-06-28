<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {

            $table->id();

            $table->string('company_name');

            $table->string('logo')->nullable();

            $table->text('tentang')->nullable();

            $table->string('alamat')->nullable();

            $table->string('telepon')->nullable();

            $table->string('email')->nullable();

            $table->string('facebook')->nullable();

            $table->string('instagram')->nullable();

            $table->string('whatsapp')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};