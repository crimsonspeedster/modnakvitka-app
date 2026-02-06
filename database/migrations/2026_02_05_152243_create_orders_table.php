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
            $table->string('status')->default('pending_payment');
            $table->decimal('total', 10, 2);
            $table->string('email')->nullable();
            $table->string('delivery_type')->default('local_pickup');
            $table->string('city')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->date('delivery_date')->useCurrent();
            $table->string('delivery_time');
            $table->boolean('is_recipient_address_knowing')->default(false);
            $table->string('text_in_postcard')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->timestamps();

            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
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
