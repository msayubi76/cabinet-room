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
        Schema::create('jdm_parts', function (Blueprint $table) {
            $table->id();
               
            $table->unsignedBigInteger('category')->nullable();
            $table->string('name')->nullable();
            $table->string('currency_type')->default('$')->nullable();
            $table->integer('price')->nullable();
            $table->string('feature_image')->nullable();
            $table->longText('part_detail')->nullable();
  
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
           // $table->foreign('product')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade'); 
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jdm_parts');
    }
};
