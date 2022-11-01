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

        Schema::create('hosting_features', function (Blueprint $table) {
            $table->id();            
            $table->string('name');
            	
        });        
       
        Schema::create('tour_activity_types', function (Blueprint $table) {
            $table->id();            
            $table->string('name');
            	
        });
        

        Schema::create('countries', function (Blueprint $table) {
            $table->id();            
            $table->string('name')->unique();
            $table->string('flag')->nullable();
            $table->string('phone_prefix')->nullable();
            $table->text('description')->nullable();
            $table->string('currency')->nullable();
            $table->enum('language', ['Ingles', 'Español', 'Frances', 'Aleman', 'Idioma Nativo Americano'])->nullable();
            $table->string('main_youtube_video')->nullable();
            $table->timestamps();
            	

        });

        Schema::create('country_parts', function (Blueprint $table) {
            $table->id();           
            $table->string('name');
            $table->unsignedBigInteger('countries_id');
            $table->timestamps();    
            $table->foreign('countries_id')->references('id')->on('countries');
            	

        });

        Schema::create('country_parts_destinations', function (Blueprint $table) {
            $table->id();           
            $table->string('name');
            $table->unsignedBigInteger('country_parts_id');
            $table->timestamps();
            $table->foreign('country_parts_id')->references('id')->on('country_parts');    
            	
        });
        
        Schema::create('hosting_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');   
            $table->string('email');
            $table->string('phone_contact');
            $table->unsignedBigInteger('country_parts_destinations_id'); 
            
            $table->double('position_lng', 8, 2)->nullable();             
            $table->double('position_lat', 8, 2)->nullable(); 
                     
            $table->text('description')->nullable();;
            $table->timestamps();
            $table->foreign('country_parts_destinations_id')->references('id')->on('country_parts_destinations');    
            	
        });

        Schema::create('hosting_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hosting_providers_id'); 
            $table->string('name');
            $table->integer('price')->nullable();;
            $table->text('description')->nullable();;
            $table->timestamps();
            $table->foreign('hosting_providers_id')->references('id')->on('hosting_providers');    
            	
        });


        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_parts_destinations_id'); 
            $table->string('name');
            $table->integer('price')->nullable();;
            $table->text('description')->nullable();;
            $table->timestamps();
            $table->foreign('country_parts_destinations_id')->references('id')->on('country_parts_destinations');    
            	
        });

        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('countries_id')->nullable();
            $table->string('name')->unique();
            $table->string('link')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('countries_id')->references('id')->on('countries');    
            	
        });

        Schema::create('rent_a_cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('countries_id')->nullable();
            $table->string('name');
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
