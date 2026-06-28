<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {

            $table->string('slogan')->nullable()->after('company_name');

            $table->string('banner')->nullable()->after('logo');

            $table->longText('google_maps')->nullable()->after('whatsapp');

            $table->string('tiktok')->nullable()->after('instagram');

            $table->string('youtube')->nullable()->after('tiktok');

            $table->string('jam_senin_jumat')->nullable();

            $table->string('jam_sabtu')->nullable();

            $table->string('jam_minggu')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'slogan',
                'banner',
                'google_maps',
                'tiktok',
                'youtube',
                'jam_senin_jumat',
                'jam_sabtu',
                'jam_minggu'
            ]);

        });
    }
};