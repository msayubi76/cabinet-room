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
            $table->string('delivered_in')->nullable()->after('is_for_request_quote');
            $table->integer('rating')->default(5)->after('delivered_in');
            $table->boolean('is_installment_available')->default(0)->after('rating');
            $table->string('sku')->nullable()->after('is_installment_available');
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
            $table->dropColumn(['delivered_in','rating','is_installment_available','sku']);
        });
    }
};
