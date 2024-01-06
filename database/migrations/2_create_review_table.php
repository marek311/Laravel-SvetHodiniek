<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->string('watch_name');
            $table->string('picture');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
