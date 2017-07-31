<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewerRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('directory_label', 30);
            $table->string('salesforce_product_code', 30);
            $table->string('rule_name', 30);
            $table->string('submitted_name_1', 30);
            $table->string('input_1', 30);
            $table->string('submitted_name_2', 30);
            $table->string('input_2', 30);
            $table->string('submitted_name_3', 30);
            $table->string('input_3', 30);
            $table->string('submitted_name_4', 30);
            $table->string('input_4', 30);
            $table->string('submitted_output', 30);
            $table->string('output', 30);
            $table->integer('created_by')->unsigned;
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::drop('rules');
    }
}
