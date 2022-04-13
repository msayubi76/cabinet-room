<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnsToJdmParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jdm_parts', function (Blueprint $table) {
            
            $table->boolean('status')->default('0')->after('part_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jdm_parts', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
