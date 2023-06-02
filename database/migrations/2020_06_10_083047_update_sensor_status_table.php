<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSensorStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropUnique('sensors_description_unique');
        });

        Schema::table('sensors', function (Blueprint $table) {
            $table->string('status', 20)->default("OK")->after('description');
            $table->float('min_allowed_temperature', 5,2)->default(0.0)->after('status');
            $table->float('max_allowed_temperature', 5,2)->default(50.0)->after('min_allowed_temperature');
            $table->timestamp('last_alarm', 0)->nullable()->after('max_allowed_temperature');
            $table->float('last_temperature', 5,2)->nullable()->after('last_alarm');
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
            $table->dropColumn(
                [
                    'status',
                    'min_allowed_temperature',
                    'max_allowed_temperature',
                    'last_alarm',
                    'last_temperature',
                ]
            );
        });

        Schema::table('sensors', function (Blueprint $table) {
            $table->unique('description');
        });
    }
}
