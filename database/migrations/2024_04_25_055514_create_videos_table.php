<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->char('slug', 36)->unique()->default(DB::raw('UUID()'));
            $table->string('title')->default('Untitled');
            $table->string('google_drive_video_id')->unique()->comment('Google drive ID of the video')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('processing_competed')->default(false)->comment('Video processing completed on google drive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
