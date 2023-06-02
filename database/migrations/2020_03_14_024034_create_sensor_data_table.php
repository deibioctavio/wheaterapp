<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sensor_id');
            $table->float('temperature', 5, 2);
            $table->text('description')->nullable();
            $table->foreign('sensor_id')
                ->references('id')
                ->on('sensors')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_data');
    }
}
