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
        Schema::create('nfts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('artist');
            $table->string('owner_id')->nullable();
            $table->text('description', 255);
            $table->string('contract_address');
            $table->string('token_standard');
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfts');
    }
};
