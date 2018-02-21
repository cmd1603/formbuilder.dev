<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('directory_label', 50);
            $table->string('salesforce_product_code', 50);
            $table->longText('configuration');
            $table->longText('workarea_html');
            $table->boolean('active')->default(0)->nullable();
            $table->integer('created_by')->unsigned;
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('templates');
    }
}
