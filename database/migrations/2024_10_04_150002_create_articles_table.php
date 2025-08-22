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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->date('date')->nullable();
            $table->longText('about_us')->nullable();
            $table->text('quote')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->nullable();
            $table->longText('image')->nullable();
            $table->longText('description')->nullable();
            $table->integer('tag_id')->nullable();
            $table->integer('law_type_id')->nullable();
            $table->integer('legal_area_id')->nullable();
            $table->integer('sub_legal_area_id')->nullable();
            $table->integer('like')->nullable();
            $table->integer('views')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
