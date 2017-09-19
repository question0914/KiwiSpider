<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('creater_id');
            $table->string('creater_role');
            $table->string('assigned_to_id');
            $table->string('project_name');
            $table->dateTimeTz('due_date');
            $table->string('description')->nullable();
            $table->string('comments')->nullable();
            $table->string('priority');
            $table->integer('progress');
            $table->dateTimeTz('reminder')->nullable();
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
        Schema::dropIfExists('tasks');
    }    
}
