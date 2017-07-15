<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function(Blueprint $table) 
        {
            $table->increments('id');
            $table->string('rule_name', 50);
            $table->string('salesforce_product_code', 50);
            $table->string('input_1', 20);
            $table->string('input_2', 20);
            $table->string('input_3', 20);
            $table->string('output', 20);
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
