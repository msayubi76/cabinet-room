<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('payment_id')->nullable()->constrained('payments');
            $table->string('order_status')->default('pending');
            $table->integer('tax')->nullable();
            $table->integer('delivery_fee')->nullable();
            $table->dateTime('cancel_at')->nullable();
            $table->foreignId('shipping_detail_id')->nullable()->constrained('shipping_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
