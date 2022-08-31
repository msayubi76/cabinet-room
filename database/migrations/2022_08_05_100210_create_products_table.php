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
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories');
            $table->string('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->decimal('actual_price')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('saleprice')->nullable();
            $table->decimal('shipping_charge')->nullable();
            $table->string('colour')->nullable();
            $table->string('folder_name')->nullable();
            $table->string('feature_image_name')->nullable();
            $table->string('feature_image')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->boolean('is_feature_product')->default('0');
            $table->boolean('is_arrival_product')->default('0');
            $table->string('currency')->default('Rs');
            $table->mediumText('short_description')->nullable();
            $table->tinyInteger('is_active')->default('0');


            $table->foreignId('created_by')->nullable()->constrained('users')->cascadeOnDelete() ;
            $table->foreignId('updated_by')->nullable()->constrained('users')->cascadeOnDelete() ;
            $table->foreignId('deleted_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
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
