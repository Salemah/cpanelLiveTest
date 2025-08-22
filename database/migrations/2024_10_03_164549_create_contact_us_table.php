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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->text('office')->nullable();
            $table->longText('address')->nullable();
            $table->longText('image')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
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
        Schema::dropIfExists('contact_us');
    }
};
