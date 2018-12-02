<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToSubscribers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribers', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->default();
            $table->foreign('user_id')
            ->references('id')->on('users')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('subscribers', 'user_id'))
        {
            Schema::table('subscribers', function($table) {
                $table->dropColumn('user_id');
            });
        }
    }
}
