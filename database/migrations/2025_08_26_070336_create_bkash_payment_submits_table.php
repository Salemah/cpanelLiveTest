<?php

use App\Models\Appointment;
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
        Schema::create('bkash_payment_submits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Appointment::class);
            $table->decimal('amount', 8, 2);
            $table->date('payment_date');
            $table->text('number');
            $table->text('trxid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_payment_submits');
    }
};
