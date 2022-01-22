<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDailyPerformanceIdAndReasonToClickupReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clickup_report', function (Blueprint $table) {
            $table->unsignedBigInteger('daily_performance_id')->nullable();
            $table->text('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clickup_report', function (Blueprint $table) {
            Schema::dropIfExists('clickup_report');
            Schema::dropIfExists('reason');
        });
    }
}
