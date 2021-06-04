<?php

namespace Database\Factories;

use App\Models\Tasktype;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasktypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tasktype::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(20)
        ];
    }
}
