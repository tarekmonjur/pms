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
//        Schema::connection("mongodb")->table('activities', function (Blueprint $collection) {
//            $collection->index('project_id');
//            $collection->index('story_id');
//            $collection->integer('task_id');
//            $collection->text('activity');
//            $collection->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::connection("mongodb")->table('activities', function (Blueprint $collection) {
//            $collection->dropIndex('project_id');
//        });
    }
}
