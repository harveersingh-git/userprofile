<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name');
            $table->string('employee_id')->after('last_name')->unique();
            $table->string('resume_title')->after('employee_id');
            $table->string('mobile')->after('resume_title')->unique();
            $table->string('joining_date');
            $table->string('shift_start')->after('joining_date');
            $table->string('shift_end')->after('shift_start');
            $table->string('team')->after('shift_end');
            $table->longText('about_employee')->after('team');
            $table->string('experience')->after('about_employee');
            
            
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
            $table->dropIfExists('last_name');
            $table->dropIfExists('employee_id');
            $table->dropIfExists('resume_title');
            $table->dropIfExists('mobile');
            $table->dropIfExists('joining_date');
            $table->dropIfExists('shift_start');
            $table->dropIfExists('shift_end');
            $table->dropIfExists('team');
            $table->dropIfExists('about_employee');
            $table->dropIfExists('experience');

        });
    }
}
