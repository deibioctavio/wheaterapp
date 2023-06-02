<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSensorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->string('power_status','10')->default('ok')->after('company_id');
            $table->boolean('enabled')->default(1)->after('company_id');
            $table->dateTime('last_check')->nullable()->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropColumn(['power_status', 'last_check', 'enabled']);
        });
    }
}
