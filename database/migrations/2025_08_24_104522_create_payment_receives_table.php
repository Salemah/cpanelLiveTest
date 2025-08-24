<?php

use App\Models\Appointment;
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
        Schema::create('payment_receives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable(); //user could be guest
            $table->foreignIdFor(Team::class)->nullable();
            $table->foreignIdFor(Appointment::class);
            $table->mediumText('notes')->nullable();
            $table->decimal('amount', 8, 2);
            $table->date('payment_date');
            $table->enum('status', ['Pending payment', 'Processing', 'Confirmed', 'Cancelled', 'Completed', 'On Hold', 'Rescheduled', 'No Show']);
            $table->json('other')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_receives');
    }
};
