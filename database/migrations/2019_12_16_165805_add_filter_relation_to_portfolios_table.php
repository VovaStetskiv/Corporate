<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilterRelationToPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            //
            $table->string('filter_alias')->after('img');
            $table->foreign('filter_alias')->references('alias')->on('filters');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            //
            if (Schema::hasColumn('portfolios', 'filter_alias'))
            {

                Schema::table('portfolios', function (Blueprint $table)
                {

                    $table->dropColumn('filter_alias');

                });

            }
        });
    }
}
