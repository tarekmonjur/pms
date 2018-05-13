<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
           $table->integer('user_id')->unsigned();
           $table->integer('project_id')->unsigned();
           $table->integer('story_id')->unsigned();
           $table->integer('task_id')->unsigned();
           $table->text('activity');
           $table->timestamp('date');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
