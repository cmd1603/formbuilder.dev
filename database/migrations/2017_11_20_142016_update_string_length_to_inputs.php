<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStringLengthToInputs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rules', function ($table) 
        {
            $table->string('submitted_name_1', 100)->change();
            $table->string('input_1', 100)->change();
            $table->string('submitted_name_2', 100)->change();
            $table->string('input_2', 100)->change();
            $table->string('submitted_name_3', 100)->change();
            $table->string('input_3', 100)->change();
            $table->string('submitted_name_4', 100)->change();
            $table->string('input_4', 100)->change();
            $table->string('submitted_output', 100)->change();
            $table->string('output', 100)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
