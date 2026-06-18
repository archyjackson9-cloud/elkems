<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
        });

        Schema::create('trusted_bys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('logo_text')->nullable();
            $table->string('logo_style')->nullable();
            $table->string('website_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trusted_bys');

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
