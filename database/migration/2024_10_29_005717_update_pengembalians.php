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
        Schema::table('pinjams', function (Blueprint $table) {
        $table->unsignedBigInteger('pinjam_id');
        $table->foreign('pinjam_id')->references('id')->on('pinjams');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjams', function (Blueprint $table) {
            //
        });
    }
};
