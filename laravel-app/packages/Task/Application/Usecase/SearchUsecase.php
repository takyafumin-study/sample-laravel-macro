<?php

namespace Task\Application\Usecase;

use Illuminate\Support\Collection;
use Task\Infra\QueryService\SearchQuery;

/**
 * Search Usecase
 */
class SearchUsecase
{
    /**
     * @param SearchQuery $query
     */
    public function __construct(private SearchQuery $query)
    {
    }

    /**
     * 検索処理
     *
     * @return Collection
     */
    public function invoke(): Collection
    {
        return $this->query->search();
    }
}
