<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("email");
            $table->enum("state", array(
                "active",
                "unsubscribed",
                "junk",
                "bounced",
                "unconfirmed"
            ))->default("unconfirmed");
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
}
