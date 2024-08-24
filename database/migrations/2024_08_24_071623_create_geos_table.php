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
        Schema::create('geos', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('city');
            $table->string('region');
            $table->string('country');
            $table->string('loc');
            $table->string('org');
            $table->string('postal');
            $table->string('timezone');

            $table->string('user_ip');
            $table->string('user_city');
            $table->string('user_region');
            $table->string('user_country');
            $table->string('user_loc');
            $table->string('user_org');
            $table->string('user_postal');
            $table->string('user_timezone');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geos');
    }
};
