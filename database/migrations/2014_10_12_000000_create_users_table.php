<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',45);
            $table->string('last_name',45);
            $table->string('email',45)->unique();
            $table->string('password',100);
            $table->rememberToken();
            $table->integer('department_id')->unsigned();
            $table->string('designation',100)->nullable();
            $table->string('mobile_no',11)->nullable();
            $table->integer('user_type')->default(0);
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('address')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_department_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}
