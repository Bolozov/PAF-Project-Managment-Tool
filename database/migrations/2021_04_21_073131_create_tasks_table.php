<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->date('deadline')->nullable();
                $table->foreignId('user_id')->constrained('users');
                $table->foreignId('project_id')->constrained('projects');
                $table->enum('status', ['créé', 'en cours', 'en attente de validation', 'validée']);
                $table->string('verification_file')->nullable();
                $table->integer('budget');
                $table->text('note')->nullable();
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
        Schema::drop('tasks');
    }
}
