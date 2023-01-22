<?php

namespace Task\Infra\Repository;

use App\Exception\AppException;
use Task\Domain\Entity\Task;
use Task\Domain\Entity\TaskFactory;
use Task\Infra\Model\Task as EloquentTask;

/**
 * タスクリポジトリ
 */
class TaskRepository
{
    /**
     * @param EloquentTask $task_model
     */
    public function __construct(
        private EloquentTask $task_model,
        private TaskFactory $factory
    ) {
    }

    /**
     * 登録
     *
     * @param Task $task_entity
     * @return Task
     */
    public function create(Task $task_entity): Task
    {
        $task_model = $this->task_model->newInstance();
        $attributes = $task_entity->toArray();
        $task_model->fill($attributes);

        if (!$task_model->save()) {
            throw new AppException('データ登録エラー');
        };

        return $this->factory->eloquent($task_model);
    }

    /**
     * 更新
     *
     * @param Task $task_entity
     * @return Task
     */
    public function update(Task $task_entity): Task
    {
        $task_model = $this->task_model->findOrFail($task_entity->id);
        $attributes = $task_entity->toArray();
        $task_model->fill($attributes);

        if (!$task_model->save()) {
            throw new AppException('データ更新エラー');
        };

        return $this->factory->eloquent($task_model);
    }

    /**
     * Eloquent Modelを返却する
     *
     * @param integer $id
     * @return Task
     */
    public function reconstruct(int $id): Task
    {
        $task_model = $this->task_model->findOrFail($id);
        return $this->factory->eloquent($task_model);
    }
}
