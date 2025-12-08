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
        Schema::create('guest_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
        $table->string('email');
        $table->string('nom');
        $table->string('prenom');
        $table->string('telephone');
        $table->decimal('amount', 10, 2);
        $table->integer('plan_id');
        $table->string('status')->default('pending'); // pending, approved, declined, canceled
        $table->string('access_code')->nullable()->unique();
        $table->timestamp('paid_at')->nullable();
        $table->timestamp('valid_until')->nullable();
        $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_payments');
    }
};
