<?php

namespace Task\Infra\QueryService;

use Illuminate\Support\Collection;
use Task\Infra\Model\Task;

/**
 * 検索クエリ
 */
class SearchQuery
{
    /**
     * 検索
     *
     * @return Collection
     */
    public function search(): Collection
    {
        $query = Task::query();
        $query->orderBy('id');

        return $query->get();
    }
}
