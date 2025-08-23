<?php

use App\Models\Team;
use App\Models\User;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable(); //user could be guest
            $table->foreignIdFor(Team::class);
            // $table->foreignIdFor(Service::class);
            $table->string('booking_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->mediumText('notes')->nullable();
            $table->decimal('amount', 8, 2);
            $table->date('booking_date');
            $table->string('booking_time');
            $table->enum('status', ['Pending payment', 'Processing', 'Confirmed', 'Cancelled', 'Completed', 'On Hold', 'Rescheduled', 'No Show']);
            $table->json('other')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
