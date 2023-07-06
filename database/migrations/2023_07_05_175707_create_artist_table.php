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
        Schema::create('artist', function (Blueprint $table) {
            $table->id();
            $table->string('ArtistName', 100);
            $table->string('PackageName', 100);
            $table->string('ImageURL')->nullable();
            $table->date('ReleaseDate');
            $table->string('SampleURL', 200)->nullable();
            $table->string('price', 200)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist');
    }
};
