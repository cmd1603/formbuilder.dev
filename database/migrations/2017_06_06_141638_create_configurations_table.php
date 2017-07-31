<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('directory_label', 50);
            $table->string('salesforce_product_code', 50);
            $table->longText('configuration');
            $table->longText('workarea_html');
            $table->boolean('active')->default(0);
            $table->integer('created_by')->unsigned;
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
        
        // Schema::create('names', function(Blueprint $table)
        // {
        //     $table->increments('id');
        //     $table->string('submitted_name', 40);
        //     $table->string('part_name', 30);
        //     $table->integer('directory_label')->unsigned;
        //     $table->foreign('directory_label')->references('id')->on('configurations');
        //     $table->integer('created_by')->unsigned;
        //     $table->foreign('created_by')->references('id')->on('users');            
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configurations');
    }
}
