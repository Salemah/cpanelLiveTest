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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->text('details')->nullable();
            $table->text('positions')->nullable();
            $table->text('fees')->nullable();
            $table->text('legal_area')->nullable();
            $table->text('sub_legal_area')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
           
            $table->enum('status', array('Active', 'Inactive'))->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('teams');
    }
};
