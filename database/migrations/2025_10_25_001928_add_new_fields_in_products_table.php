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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->nullable()->after('sku')->comment('Weight in kg');
            $table->decimal('length', 8, 2)->nullable()->change();
            $table->decimal('width', 8, 2)->nullable()->change();
            $table->decimal('height', 8, 2)->nullable()->after('width');
            $table->string('weight_unit')->default('kg')->after('weight');
            $table->text('tcs_product_description')->nullable()->after('weight_unit');
            
            // Make existing dimensions consistent
            $table->string('dimension_unit')->default('cm')->after('height');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'weight', 
                'height', 
                'weight_unit', 
                'tcs_product_description',
                'dimension_unit'
            ]);
        });
    }
};
