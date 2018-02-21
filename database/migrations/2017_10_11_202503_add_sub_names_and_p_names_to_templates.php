<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubNamesAndPNamesToTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('templates', function($table)
        {
            $table->longText('submitted_names')->after('active');
            $table->longText('part_numbers')->after('submitted_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->dropcolumn('submitted_names');
            $table->dropcolumn('part_numbers');
        });
    }
}
