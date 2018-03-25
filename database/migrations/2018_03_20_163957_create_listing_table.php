<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('good_id')->unsigned();
			$table->integer('good_group_id')->unsigned();
			//$table->primary(['good_id', 'good_group_id']);
			
			/*$table->foreign('good_id')
				->references('id')->on('goods');
			$table->foreign('good_group_id')
				->references('id')->on('good_groups');*/ 
        });
		
		Schema::table('listings', function(Blueprint $table) {
			$table->foreign('good_id')->references('id')->on('goods')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('good_group_id')->references('id')->on('good_groups')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
