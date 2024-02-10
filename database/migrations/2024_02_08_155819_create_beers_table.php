<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('beers')) {
            Schema::create('beers', function (Blueprint $table) {
                $table->id()->unique();
                $table->string('name');
                $table->string('tagline');
                $table->string('first_brewed');
                $table->text('description');
                $table->float('abv');
                $table->float('ibu');
                $table->string('image_url');
                $table->json('food_pairing');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beers');
    }
};
