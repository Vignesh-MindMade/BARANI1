<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Blogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $tableName = 'blogs';
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();        
            $table->string('thumbnail')->nullable();
            $table->enum('type', ['pdf', 'video', 'gallery']);
            $table->string('pdf_file')->nullable();
            $table->enum('video_source', ['upload', 'url'])->nullable();
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('status')->default(false);
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
        //
        $tableName = 'blogs';
        Schema::dropIfExists($tableName);
    }
}

 
