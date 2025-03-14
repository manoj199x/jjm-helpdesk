<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactsColumnToIssueTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_issue_trackings', function (Blueprint $table) {
            //
            $table->string('phone_number')->after('users_id');
            $table->string('email')->after('users_id');
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
            $table->dropColumn('phone_number','email');
        });
    }
}
