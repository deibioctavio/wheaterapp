<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropUnique('companies_description_unique');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
            $table->string('description', 200)->nullable()->change();
            $table->string('phone1', 15)->nullable()->after('description');
            $table->string('phone2', 15)->nullable()->after('phone1');
            $table->string('email', 50)->nullable()->after('phone2');
            $table->string('contact_person', 100)->nullable()->after('email');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->string('name', 50)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropUnique('companies_name_unique');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->text('name')->nullable()->change();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->string('description', 100)->nullable()->unique()->change();
            $table->dropColumn(
                [
                    'phone1',
                    'phone2',
                    'email',
                    'contact_person',
                ]
            );
        });
    }
}
