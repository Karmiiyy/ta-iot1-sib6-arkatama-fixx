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
        Schema::create('l_e_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pin');
            $table->boolean('status')
                ->default(false);
            $table->timestamps(); //created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_e_d_s');
    }
};
