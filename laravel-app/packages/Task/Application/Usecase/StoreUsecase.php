<?php

namespace Task\Application\Usecase;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Task\Domain\Entity\TaskFactory;
use Task\Infra\Repository\TaskRepository;

/**
 * Store Usecase
 */
class StoreUsecase
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
     * 登録処理
     *
     * @return int|null
     */
    public function invoke(array $attributes): ?int
    {
        // Entity生成
        $task_entity = $this->factory->create($attributes);

        /** @var \Task\Domain\Entity\Task $created_task_entity */
        $created_task_entity = DB::transaction(function () use ($task_entity) {
            return $this->repository->create($task_entity);
        });

        return $created_task_entity->id;
    }
}
