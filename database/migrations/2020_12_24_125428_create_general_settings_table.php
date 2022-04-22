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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
             
            $table->string('japan_rate')->nullable();
            $table->longText('welcome_message')->nullable();
            
            $table->string('ceo_image')->nullable();
            $table->string('ceo_name')->nullable();
            $table->longText('ceo_message')->nullable();

            $table->string('df_image')->nullable();
            $table->string('df_name')->nullable();
            $table->longText('df_message')->nullable();

            $table->string('head_office_address')->nullable();
            $table->string('branch_address')->nullable();

            $table->string('tel_1')->nullable();
            $table->string('mobile_1')->nullable();
            $table->string('fax_1')->nullable();

            $table->string('tel_2')->nullable();
            $table->string('mobile_2')->nullable();
            $table->string('fax_2')->nullable();

            
            $table->string('email_1')->nullable();
            $table->string('email_2')->nullable();
            $table->string('email_3')->nullable();
  
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade'); 
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
