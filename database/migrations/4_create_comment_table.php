<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_comment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_id');
            $table->text('content');
            $table->foreign('review_id')->references('id')->on('review')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_comment');
    }
};
