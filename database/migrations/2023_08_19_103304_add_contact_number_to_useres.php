<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactNumberToUseres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_users', function (Blueprint $table) {
            $table->string('contact_number')
                ->after('email')
                ->nullable();
            //

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_users', function (Blueprint $table) {
            $table->dropColumn('contact_number');
        });
    }
}
