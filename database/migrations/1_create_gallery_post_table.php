<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_post', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('picture');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('gallery_post');
    }
};
