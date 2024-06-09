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
        //
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('pro_first_name');
            $table->string('pro_last_name');
            $table->string('pro_image_path');
            $table->enum('pro_status', ['inactive', 'pending', 'active']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('profiles');

    }
};
