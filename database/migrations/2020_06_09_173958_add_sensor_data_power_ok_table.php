<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSensorDataPowerOkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->boolean('power_ok')->default(1)->after('temperature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->dropColumn(['power_ok']);
        });
    }
}
