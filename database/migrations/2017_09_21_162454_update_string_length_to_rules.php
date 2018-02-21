<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStringLengthToRules extends Migration
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
            $table->string('directory_label', 60)->change();
            $table->string('salesforce_product_code', 60)->change();
            $table->string('rule_name', 60)->change();
            $table->string('submitted_name_1', 60)->change();
            $table->string('input_1', 60)->change();
            $table->string('submitted_name_2', 60)->change();
            $table->string('input_2', 60)->change();
            $table->string('submitted_name_3', 60)->change();
            $table->string('input_3', 60)->change();
            $table->string('submitted_name_4', 60)->change();
            $table->string('input_4', 60)->change();
            $table->string('submitted_output', 60)->change();
            $table->string('output', 60)->change();
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
