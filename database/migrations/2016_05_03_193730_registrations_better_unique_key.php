<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationsBetterUniqueKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('registrations', function(Blueprint $table) {
            $table->dropUnique(['name', 'workshop']);
            $table->unique(['name', 'uni', 'workshop']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('registrations', function(Blueprint $table) {
            $table->dropUnique(['name', 'uni', 'workshop']);
            $table->unique(['name', 'workshop']);
        });
    }
}
