<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sentences', function($t)
        {
                $t->increments('id');
                $t->string('subject');
                $t->string('action');
                $t->string('object');
                $t->string('subject_url');
                $t->string('object_url');
                $t->string('action_url');
                $t->string('location');
                $t->string('location_url');
                $t->text('full_text');
                $t->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sentences');
	}

}
