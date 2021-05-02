<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'ref_project' => $this->faker->randomDigitNotNull,
        'name_project' => $this->faker->text,
        'budget_project' => $this->faker->randomDigitNotNull,
        'start_date_project' => $this->faker->word,
        'end_date_project' => $this->faker->word,
        'status_project' => $this->faker->word,
        'responsible_id_project' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
