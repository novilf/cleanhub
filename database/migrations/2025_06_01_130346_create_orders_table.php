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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('date');
            $table->string('service_type');
            $table->text('detail_clothes');
            $table->decimal('price', 10, 2);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('laundry_status', ['pickup', 'service', 'completed'])->default('pickup');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
