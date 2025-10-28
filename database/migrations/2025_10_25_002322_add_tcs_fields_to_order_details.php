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
            // Add TCS-specific fields for individual items
            $table->decimal('item_weight', 8, 2)->nullable()->after('price');
            $table->decimal('item_length', 8, 2)->nullable()->after('item_weight');
            $table->decimal('item_width', 8, 2)->nullable()->after('item_length');
            $table->decimal('item_height', 8, 2)->nullable()->after('item_width');
            $table->string('tcs_item_description')->nullable()->after('item_height');
            $table->decimal('declared_value', 10, 2)->nullable()->after('tcs_item_description');
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
        Schema::table('order_details', function (Blueprint $table) {
           [ 'item_weight',
                'item_length', 
                'item_width',
                'item_height',
                'tcs_item_description',
                'declared_value'];
            //
        });
    }
};
