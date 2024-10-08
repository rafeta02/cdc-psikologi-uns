<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    protected $model = \App\Models\Vacancy::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->jobTitle;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'company_id' => $this->faker->numberBetween(1, 30),  // Assuming Company model has a factory
            'description' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement(['fulltime', 'parttime', 'internship']),
            'open_date' => $this->faker->dateTimeBetween('-2 month', 'now')->format('d-m-Y'),
            'close_date' => $this->faker->dateTimeBetween('-1 week', '+3 months')->format('d-m-Y'),
            'persyaratan_umum' => $this->faker->paragraph(),
            'persyaratan_khusus' => $this->faker->paragraph(),
            'registration' => $this->faker->sentence(),
            'job_description' => $this->faker->paragraphs(2, true),
            'minimum_gpa' => $this->faker->randomFloat(2, 0, 4),
            'experience_id' => $this->faker->numberBetween(1, 6),
            'position_id' => $this->faker->numberBetween(1, 3),  // Assuming Position model has a factory
            'industry_id' => $this->faker->numberBetween(1, 3),  // Assuming Industry model has a factor // Assuming Industry model has a factory
            'created_by_id' => 1,
        ];
    }
}
