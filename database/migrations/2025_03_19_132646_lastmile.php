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
        Schema::create('delivery_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('delivery_routes_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_routes_id');
            $table->unsignedBigInteger('country_parts_destinations_id');
            $table->timestamps();
            $table->foreign('delivery_routes_id')->references('id')->on('delivery_routes');
            $table->foreign('country_parts_destinations_id')->references('id')->on('country_parts_destinations');

        });

        Schema::create('delivery_guides', function (Blueprint $table) {
            $table->id();            
            $table->timestamps();
            $table->unsignedBigInteger('creator_users_id');
            $table->unsignedBigInteger('assigned_users_id');
            $table->string('status')->unique(); //  draft, assigned-to, on-progress, canceled, delivered
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
        Schema::dropIfExists('delivery_routes_locations');
        Schema::dropIfExists('delivery_routes');

    }
};
