<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CountryPartsDestination;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HostingProvider>
 */
class HostingProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        https://www.google.com/maps/place/San+Jos%C3%A9/@,,12z/data=!3m1!4b1!4m13!1m7!3m6!1s0x8f92e56221acc925:0x6254f72535819a2b!2sCosta+Rica!3b1!8m2!3d9.748917!4d-83.753428!3m4!1s0x8fa0e342c50d15c5:0xe6746a6a9f11b882!8m2!3d9.9282714!4d-84.0907288

        $point =\Faker\Geo::point([[9.3356876,-84.4486378 ], [8.5, -84.6486378]]);

        $random_country_part_destination = CountryPartsDestination::all()->random(1)->first();

        return [
            'name' => 'Hotel ' . fake()->name(),
            'country_parts_destinations_id'=>  $random_country_part_destination->id, 
            'email' => fake()->unique()->safeEmail(),
            'phone_contact' =>  fake()->phoneNumber() ,
            'position_lng' => $point[1] ,
            'position_lat' => $point[0],
            
            
        ];
    }
}
