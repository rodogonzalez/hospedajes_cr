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
        $point = \Faker\Geo\MexicoCity::point();
        $random_country_part_destination = CountryPartsDestination::all()->random(1)->first();

        return [
            'name' => 'Hotel ' . fake()->name(),
            'country_parts_destinations_id'=>  $random_country_part_destination->id, 
            'email' => fake()->unique()->safeEmail(),
            'phone_contact' =>  fake()->phoneNumber() ,
            'position_lng' => $point[0] ,
            'position_lat' => $point[1],
            
            
        ];
    }
}
