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
        return [
            'name' => $this->faker->jobTitle,
            'slug' => Str::slug($this->faker->jobTitle),
            'company_id' => \App\Models\Company::factory(),  // Assuming Company model has a factory
            'description' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement(['fulltime', 'partime', 'internship']),
            'open_date' => $this->faker->dateTimeThisYear()->format('d-m-Y'),
            'close_date' => $this->faker->dateTimeThisYear()->format('d-m-Y'),
            'persyaratan_umum' => $this->faker->paragraph(),
            'persyaratan_khusus' => $this->faker->paragraph(),
            'registration' => $this->faker->sentence(),
            'job_description' => $this->faker->paragraphs(2, true),
            'position_id' => \App\Models\Position::factory(),  // Assuming Position model has a factory
            'industry_id' => \App\Models\Industry::factory(),  // Assuming Industry model has a factory
            'created_by_id' => 1,
        ];
    }
}