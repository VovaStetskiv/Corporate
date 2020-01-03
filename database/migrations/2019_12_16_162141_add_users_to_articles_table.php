<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            //

            $table->integer('user_id')->unsigned()->after('img');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //

            if (Schema::hasColumn('articles', 'user_id'))
            {

                Schema::table('articles', function (Blueprint $table)
                {

                    $table->dropColumn('user_id');

                });

            }

        });
    }
}
