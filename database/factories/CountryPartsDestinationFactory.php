<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;


use App\Models\CountryPart;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CountryPartsDestination>
 */
class CountryPartsDestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random_country_part = CountryPart::all()->random(1)->first();
        $name =  fake()->name();
        $area_distance = 0.01;

        $start_begin_x = $random_country_part->position_lat - $area_distance;
        $start_begin_y = $random_country_part->position_lng - $area_distance;

        $start_end_x = $random_country_part->position_lat + $area_distance;
        $start_end_y = $random_country_part->position_lng + $area_distance;

        $point =\Faker\Geo::point([[   $start_begin_x,$start_begin_y ], [$start_end_x, $start_end_y]]);


        
        return [
            //
            'name'=>  $name ,
            'country_parts_id'=>  $random_country_part->id,            
            'slug'=> Str::slug($name, '-'),
            'position_lng' => $point[1] ,
            'position_lat' => $point[0],

        ];
    }
}
