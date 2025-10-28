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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('tcs_tracking_number')->nullable()->after('order_receipt');
            $table->string('tcs_consignment_number')->nullable()->after('tcs_tracking_number');
            $table->text('tcs_receipt_url')->nullable()->after('tcs_consignment_number');
            $table->text('tcs_label_url')->nullable()->after('tcs_receipt_url');
            $table->json('tcs_shipment_data')->nullable()->after('tcs_label_url');
            $table->string('tcs_status')->nullable()->after('tcs_shipment_data');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'tcs_tracking_number',
                'tcs_consignment_number', 
                'tcs_receipt_url',
                'tcs_label_url',
                'tcs_shipment_data',
                'tcs_status'
            ]);
            //
        });
    }
};
