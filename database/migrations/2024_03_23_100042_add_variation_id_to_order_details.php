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
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->foreignId('variation_id')->nullable()->after('product_id')->constrained('variations')->cascadeOnDelete();
        });
        Schema::table('shipping_details', function (Blueprint $table) {
            //
            $table->dropColumn('post_code');
        });
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->decimal('total_amount')->nullable()->after('shipping_charges');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->dropForeign('order_details_variation_id_foreign');
            $table->dropColumn('variation_id');
        });
        
        Schema::table('shipping_details', function (Blueprint $table) {
            //
            $table->string('post_code')->nullable();
        });
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->dropColumn('total_amount');
        });

    }
};
