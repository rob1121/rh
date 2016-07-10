<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statuses', function(Blueprint $table)
        {
            $table->integer('device_id')->unsigned()->after('id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function(Blueprint $table)
        {
            $table->dropForeign('statuses_device_id_foreign');
            $table->dropColumn('device_id');

        });
    }
}
