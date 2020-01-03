<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {

            $table->integer('article_id')->unsigned()->after('parent_id');
            $table->foreign('article_id')->references('id')->on('articles');

            $table->integer('user_id')->unsigned()->nullable()->after('article_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('comments', function (Blueprint $table) {
            //
            if (Schema::hasColumn('comments', 'article_id') &&  Schema::hasColumn('comments', 'user_id'))
            {

                Schema::table('comments', function (Blueprint $table)
                {

                    $table->dropColumn('article_id');
                    $table->dropColumn('user_id');

                });

            }
        });
    }
}
