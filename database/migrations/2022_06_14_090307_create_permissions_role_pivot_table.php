<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsRolePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')->references('id')->on('help_roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->references('id')->on('help_permissions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_permission_role');
    }
}
