<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('story_id')->unsigned();
            $table->string('task_title');
            $table->enum('task_type', ['task', 'bug', 'issue']);
            $table->date('task_start_date')->nullable();
            $table->date('task_end_date')->nullable();
            $table->text('task_details')->nullable();
            $table->enum('task_status', ['pending', 'progress', 'postponed', 'done']);
            $table->integer('assign_by')->unsigned()->default(0);
            $table->integer('assign_to')->unsigned()->default(0);
            $table->integer('created_by')->unsigned()->default(0);
            $table->integer('updated_by')->unsigned()->default(0);
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_project_id_foreign');
            $table->dropForeign('tasks_story_id_foreign');
        });
        Schema::dropIfExists('tasks');
    }
}
