<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/*
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('link_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('youtube_video')->nullable();
            $table->text('countries')->nullable();
            $table->timestamps();

        });

*/

        Schema::create('hosting_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('tour_activity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('countries', function (Blueprint $table) {
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

        Schema::create('country_parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->float('position_lng', 10, 6)->nullable();
            $table->float('position_lat', 10, 6)->nullable();
            $table->unsignedBigInteger('countries_id');
            $table->string('youtube_video')->nullable();
            $table->timestamps();
            $table->text('photos')->nullable();
            $table->foreign('countries_id')->references('id')->on('countries');
        });

        Schema::create('country_parts_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->float('position_lng', 10, 6)->nullable();
            $table->float('position_lat', 10, 6)->nullable();
            $table->string('youtube_video')->nullable();
            $table->unsignedBigInteger('country_parts_id');
            $table->text('photos')->nullable();
            $table->timestamps();
            $table->foreign('country_parts_id')->references('id')->on('country_parts');
        });

        Schema::create('hosting_providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_users_id');
            $table->string('name');
            $table->string('slug');
            $table->string('email')->nullable();
            ;
            ;
            $table->string('phone_contact')->nullable();
            ;
            ;
            $table->unsignedBigInteger('country_parts_destinations_id')->nullable();
            ;
            ;
            $table->string('youtube_video')->nullable();
            $table->float('position_lng', 10, 6)->nullable();
            $table->float('position_lat', 10, 6)->nullable();
            $table->text('description')->nullable();
            ;
            $table->text('photos')->nullable();
            $table->timestamps();
            $table->foreign('country_parts_destinations_id')->references('id')->on('country_parts_destinations');
        });

        Schema::create('hosting_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hosting_providers_id');            
            $table->string('name');
            $table->string('slug');
            $table->integer('price')->nullable();
            ;
            $table->text('description')->nullable();
            ;
            $table->text('features')->nullable();
            ;
            $table->timestamps();
            $table->foreign('hosting_providers_id')->references('id')->on('hosting_providers');

        });


        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_parts_destinations_id');
            $table->string('name');
            $table->string('slug');
            $table->string('youtube_video')->nullable();
            $table->integer('price')->nullable();
            $table->float('position_lng', 10, 6)->nullable();
            $table->float('position_lat', 10, 6)->nullable();
            $table->text('description')->nullable();
            $table->text('photos')->nullable();
            $table->timestamps();
            $table->foreign('country_parts_destinations_id')->references('id')->on('country_parts_destinations');

        });

        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('countries_id')->nullable();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('link')->nullable();
            $table->string('logo')->nullable();
            $table->string('youtube_video')->nullable();
            $table->text('countries')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('countries_id')->references('id')->on('countries');

        });

        Schema::create('rent_a_cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('countries_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('youtube_video')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('countries_id')->references('id')->on('countries');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospedaje_tables');
    }
};