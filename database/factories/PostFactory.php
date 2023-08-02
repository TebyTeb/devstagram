<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
  //-- Los Factories sirven como herramienta de testing contra la BD --//
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Aquí definimos los datos que vamos a pasar a la BD
            // Usamos Faker para introducir datos "aleatorios" (vienen de librerias) en la BD
            'titulo' => $this->faker->sentence(5), // Faker genera frases con un numero fijo o variable de palabras
            'descripcion' => $this->faker->sentence(25),
            'imagen' => $this->faker->uuid().'.jpg', // Faker puede generar uuid's y le podemos concatenar texto
            'user_id' => $this->faker->randomElement([1, 2])
        ];
    }
}
