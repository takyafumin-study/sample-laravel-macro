<?php

namespace Database\Factories;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Task\Domain\Status;
use Task\Infra\Model\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $now = CarbonImmutable::now();
        return [
            'title'       => fake()->realText(10) . 'する',
            'description' => fake()->realText(255),
            'status'      => Status::NONE->value,
            'assign_to'   => null,
            'created_at'  => $now,
            'created_by'  => 0,
            'updated_at'  => $now,
            'updated_by'  => 0
        ];
    }
}
