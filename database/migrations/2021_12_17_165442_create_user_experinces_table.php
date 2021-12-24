<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExperincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_experinces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
           $table->foreign('user_id')->references('id')->on('users'); 
            $table->string('order')->nullable();
            $table->string('company_name');
            $table->string('designation')->nullable();
            $table->text('role_responsibilitie');
            $table->date('from');
            $table->date('to');
            $table->string('present')->nullable();
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
        Schema::dropIfExists('user_experinces');
    }
}
