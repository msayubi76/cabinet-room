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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('name');
            $table->mediumText('description');
            $table->integer('actual_price');
            $table->integer('discount');
            $table->integer('shipping_charge');
            $table->string('colour');
            $table->string('feature_image');
            $table->string('images');
            $table->integer('length');
            $table->integer('width');
            $table->boolean('is_feature_product');
            $table->boolean('is_arrival_product');

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
        Schema::dropIfExists('products');
    }
};
