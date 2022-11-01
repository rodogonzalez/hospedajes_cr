<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

 

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
        
        return [
            //
            'name'=> 'Demo Point' . fake()->name() ,
            'country_parts_id'=>  $random_country_part->id, 

        ];
    }
}
