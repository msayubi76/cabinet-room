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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();

            $table->mediumText('about_us_detail')->nullable();
            $table->mediumText('contact_us_detail')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile_no1')->nullable();
            $table->string('mobile_no2')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->mediumText('privacyAndPolicyDetail')->nullable();


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
        Schema::dropIfExists('setting');
    }
};
