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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is_active')->default('0');

            $table->string('image_url')->nullable();
            $table->string('image_folder')->nullable();
            $table->string('image_name')->nullable();
            $table->tinyInteger('sort_order')->default('0');
            
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
       
        Schema::dropIfExists('categories');
    }
};
