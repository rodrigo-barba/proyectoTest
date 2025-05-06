<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /** Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //genero un nombre falso
        $name = $this->faker->name();

        //definicion de los valores a devolver 
        return [
            'title' => $name,
            'slug' => str($name)->slug(),
            'content' => $this->faker->paragraph(20),
            'description' => $this->faker->paragraph(4),
            'category_id' => $this->faker->randomElement([1,2,4,5,7,8,10]),
            'posted' => $this->faker->randomElement(['yes', 'not']),
            'image' => $this->faker->imageUrl(),
            'user_id' => $this->faker->randomElement([1,2,3])
        ];
    }
}
