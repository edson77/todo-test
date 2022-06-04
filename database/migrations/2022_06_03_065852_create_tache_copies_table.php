<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacheCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_copy', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name',250);
            $table->text('description')->nullable();
            $table->dateTime('end_task');
            $table->boolean('completed')->default(false);
            $table->integer('user_id');
            $table->integer('list_id');
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
        Schema::dropIfExists('tasks_copy');
    }
}
