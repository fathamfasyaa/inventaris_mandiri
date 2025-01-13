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
        Schema::table('tm_pengembalian', function (Blueprint $table) {
            $table->foreign('pb_id')->references('pb_id')->on('tm_peminjaman');
    $table->foreign('user_id')->references('user_id')->on('tm_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_pengembalian', function (Blueprint $table) {
            //
        });
    }
};
