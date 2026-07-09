<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('banner-image');
            $table->string('banner-title')->nullable();
            $table->string('Section1-subtitle')->nullable();
            $table->string('Section1-title')->nullable();
            $table->text('Section1-description')->nullable();

            $table->string('title');                           // Card title
            $table->text('description')->nullable();           // Card description
            // Card Thumbnail
            $table->string('card_thumbnail')->nullable();
            $table->enum('type', ['pdf', 'video', 'image'])->default('pdf');

            // PDF type fields
            $table->string('pdf_file')->nullable(); // path to uploaded PDF
            
            // Video type fields
            $table->string('video_source')->nullable(); // 'upload' or 'link'
            $table->string('video_file')->nullable(); // path to uploaded video
            $table->string('video_url')->nullable(); // external link (YouTube embed, Vimeo, etc.)
            $table->string('video_thumbnail')->nullable(); // custom thumbnail
            
            // Image type fields
            // Images will be stored in a separate table (blog_images)
            
            $table->string('thumbnail')->nullable(); // card thumbnail image
            $table->date('published_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
