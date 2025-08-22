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
        Schema::create('sub_legal_areas', function (Blueprint $table) {
            $table->id();
            $table->integer('legal_area_id')->nullable();
            $table->string('name')->nullable();
            $table->text('image')->nullable();
            $table->text('icon')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->nullable();
            $table->longText('description')->nullable();
            $table->integer('added_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_legal_areas');
    }
};
