<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = \App\Models\Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'slug' => Str::slug($this->faker->company),
            'description' => $this->faker->paragraph(),
            'address' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
            'website' => $this->faker->url,
            'scale' => $this->faker->randomElement(['mikro', 'kecil', 'menengah']),
            'number_of_employee' => $this->faker->numberBetween(10, 1000),
            'ownership' => $this->faker->randomElement(['negara', 'swasta']),
            'industry_id' => \App\Models\Industry::factory(),
            'location' => $this->faker->city,
        ];
    }
}
