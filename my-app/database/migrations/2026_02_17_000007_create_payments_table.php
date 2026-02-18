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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method'); // "Tarjeta", "Transferencia", "Efectivo"
            $table->string('status')->default('completed'); // "pending", "completed", "failed"
            $table->string('transaction_id')->nullable()->unique();
            $table->text('notes')->nullable();
            $table->timestamp('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
