<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class listingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),           #$this->faker refers to an instance of the Faker generator.After that are different methods for providing fake content.
            'reporter'=>$this->faker->word,
            'status'=>'open',
'tags' => 'tiger,leopard,theft',
'venue' => $this->faker->city(),
'description' => $this->faker->paragraph (5),     #5 sentences
'date'=>$this->faker->date,
'time'=>$this->faker->time,
        ];
    }
}
