<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptToIssueTrackings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_issue_trackings', function (Blueprint $table) {
            $table->string('accept')->after('application_status')->nullable();
            $table->string('is_closed')->after('application_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_issue_trackings', function (Blueprint $table) {
            $table->dropColumn('accept','is_closed');
        });
    }
}
