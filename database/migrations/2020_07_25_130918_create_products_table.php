<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{ 
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('make')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();  
            $table->string('model')->nullable();
            $table->string('package')->nullable();
            $table->string('year')->nullable();
            $table->longText('image')->nullable();
            
            $table->string('hybrid_petrol_diesel')->nullable();
            $table->string('_wd_4wd')->nullable();
            $table->integer('seats')->nullable();

            $table->string('chassis_no')->unique()->nullable();
            $table->string('cc')->nullable();
            $table->string('color')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->nullable();
            $table->string('power_window')->nullable();
            $table->string('power_stearing')->nullable();
            $table->string('ac_aac')->nullable();
            $table->string('navigation_tc_dvd')->nullable();
            $table->string('steering_audio_controls')->nullable();
            $table->string('cruise_controls')->nullable();
            $table->string('paddle_shifters')->nullable();
            $table->string('key_start_push_start')->nullable();
            $table->string('alloys')->nullable();
            $table->string('fog')->nullable();
            $table->string('rear_spoiler')->nullable();
            $table->string('door_visors')->nullable();
            $table->string('aero_kit')->nullable();
            $table->string('leather_seats')->nullable();
            $table->string('back_camera')->nullable();
            $table->string('bumper_sensors')->nullable();
            $table->string('sunroof_penoramic')->nullable();
            $table->string('retractable_side_mirrors')->nullable();

            $table->string('keyless_entry')->nullable();
            $table->string('back_tyre')->nullable();
            $table->string('abs')->nullable();
            $table->string('ab')->nullable();

            $table->boolean("is_active")->default(1)->comment("1:Active, 0:Non Active");
            $table->boolean("status")->default(0)->comment("0:Not Quote, 1:Reserved, 2:Shipped");
            $table->boolean("is_reserved")->default(0)->comment("1:Reserved, 0:Non Reserved");

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        
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
}
