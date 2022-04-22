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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('coordinator_image')->after('df_message')->nullable();
            $table->string('coordinator_name')->after('coordinator_image')->nullable();
            $table->string('coordinator_message')->after('coordinator_name')->nullable();
            $table->string('hirose_president_image')->after('coordinator_message')->nullable();
            $table->string('hirose_president_name')->after('hirose_president_image')->nullable();
            $table->string('hirose_president_message')->after('hirose_president_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['coordinator_image', 'coordinator_name', 'coordinator_message', 'hirose_president_image', 'hirose_president_name', 'hirose_president_message' ]);
        });
    }
};
