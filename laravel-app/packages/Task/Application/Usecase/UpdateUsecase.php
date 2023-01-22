<?php

namespace Task\Application\Usecase;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Task\Domain\Entity\Task;
use Task\Domain\Entity\TaskFactory;
use Task\Infra\Repository\TaskRepository;

/**
 * Update Usecase
 */
class UpdateUsecase
{
    /**
     * @param TaskRepository $repository
     */
    public function __construct(
        private TaskFactory $factory,
        private TaskRepository $repository
    ) {
    }

    /**
     * 更新処理
     *
     * @return int|null
     */
    public function invoke(int $id, array $attributes): ?int
    {
        /** @var \Task\Domain\Entity\Task $updated_task_entity */
        $updated_task_entity = DB::transaction(function () use ($id, $attributes) {
            // 更新前 Entity
            $task_entity = $this->repository->reconstruct($id);

            // 値反映
            $updated_task_entity = $task_entity->apply($attributes);

            // 保存
            return $this->repository->update($updated_task_entity);
        });

        return $updated_task_entity->id;
    }
}
