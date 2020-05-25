<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamecategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamecategories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name")->default("");
            $table->string("steamId");
        });

        Schema::create("gamecategorylink", function( Blueprint $table) {
            $table->id();
            $table->integer("gameId");
            $table->integer("categoryId");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gamecategories');
        Schema::dropIfExists('gamecategorylink');
    }
}
