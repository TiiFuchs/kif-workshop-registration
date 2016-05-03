<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistrationUniMailColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('registrations', function (Blueprint $table) {
            $table->string("uni");
            $table->string("email");
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
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['uni', 'email']);
        });
    }
}
