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
        //

        Schema::create('location_route_points', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('flag')->nullable();
            $table->float('position_lng', 10, 6)->nullable();
            $table->float('position_lat', 10, 6)->nullable();
            $table->string('phone_prefix')->nullable();
            $table->text('description')->nullable();
            $table->string('currency')->nullable();
            $table->enum('language', ['Ingles', 'Español', 'Frances', 'Aleman', 'Idioma Nativo Americano'])->nullable();
            $table->string('youtube_video')->nullable();
            $table->string('slug');
            $table->timestamps();
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
    }
};
