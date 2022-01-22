<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->unsignedBigInteger('client_status_id');
            // $table->foreign('client_status_id')->references('id')->on('client_statuses');
            $table->string('client_code');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('map')->nullable();
            // $table->unsignedBigInteger('team_id');
            // $table->foreign('team_id')->references('id')->on('teams');
            // $table->unsignedBigInteger('work_type_id');
            // $table->foreign('work_type_id')->references('id')->on('work_types');
            $table->string('hours');
            $table->date('starting_date');
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
        Schema::dropIfExists('clients');
    }
}
