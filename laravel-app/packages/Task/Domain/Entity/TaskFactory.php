<?php

namespace Task\Domain\Entity;

use Task\Domain\Status;
use Task\Infra\Model\Task as EloquentTask;

/**
 * タスク Factory
 */
class TaskFactory
{
    /**
     * create
     *
     * @param array $attributes
     * @return Task
     */
    public static function create(array $attributes): Task
    {
        $assign_to = $attributes['assgin_to'] ?? null;
        return new Task(
            null,
            $attributes['title'],
            $attributes['description'],
            Status::NONE,
            $attributes['assgin_to'] ?? null,
        );
    }

    /**
     * eloquent
     *
     * @param EloquentTask $task_model
     * @return Task
     */
    public static function eloquent(EloquentTask $task_model): Task
    {
        return new Task(
            $task_model->id,
            $task_model->title,
            $task_model->description,
            Status::from($task_model->status),
            $task_model->assgin_to
        );
    }
}
