<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemarksToAssignHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_assign_histories', function (Blueprint $table) {
            //
            $table->text('from_remarks')->after('status')->nullable();
            $table->text('to_remarks')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_assign_histories', function (Blueprint $table) {

            $table->dropColumn('from_remarks','to_remarks');
        });
    }
}
