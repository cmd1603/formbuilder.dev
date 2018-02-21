<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_people', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('did');
            $table->text('sales_person', 100);
            $table->timestamps();
            $table->softDeletes();      

            $table->unique(['did', 'sales_person']);      
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
