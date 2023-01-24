<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CountryPartsDestination;

use Illuminate\Support\Str;
use netdjw\LoremIpsum\Http\Controllers\LoremIpsumController as LoremIpsum;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HostingProvider>
 */
class HostingProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */   public function definition()
    {
        
        
        $area_distance = 0.01;       
        $random_country_part_destination = CountryPartsDestination::all()->random(1)->first();

        $start_begin_x = $random_country_part_destination->position_lat - $area_distance;
        $start_begin_y = $random_country_part_destination->position_lng - $area_distance;

        $start_end_x = $random_country_part_destination->position_lat + $area_distance;
        $start_end_y = $random_country_part_destination->position_lng + $area_distance;

        $point =\Faker\Geo::point([[   $start_begin_x,$start_begin_y ], [$start_end_x, $start_end_y]]);
        $lipsum = new LoremIpsum();

        $text =  $lipsum->plainText('la', 5);
       // echo $text;

        $name =  fake()->name();
        return [
            'name' => 'Hotel ' . $name,
            'slug'=> Str::slug($name, '-'),
            'country_parts_destinations_id'=>  $random_country_part_destination->id, 
            'email' => fake()->unique()->safeEmail(),
            'phone_contact' =>  fake()->phoneNumber() ,
            'position_lng' => $point[1] ,
            'position_lat' => $point[0],
            'description' => $text,

            
            
            
        ];
    }
}
