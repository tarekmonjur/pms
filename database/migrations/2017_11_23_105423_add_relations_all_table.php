<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            if(Schema::hasTable('departments')){
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasTable('users')){
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict');
            }
        });

        Schema::table('stories', function (Blueprint $table) {
            if(Schema::hasTable('stories')){
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            }
        });

        Schema::table('tasks', function (Blueprint $table) {
            if(Schema::hasTable('tasks')){
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
                $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
            }
        });

        Schema::table('task_comments', function (Blueprint $table) {
            if(Schema::hasTable('task_comments')){
                $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            }
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
