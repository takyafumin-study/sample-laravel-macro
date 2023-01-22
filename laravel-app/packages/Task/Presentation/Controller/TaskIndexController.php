<?php

namespace Task\Presentation\Controller;

use App\Http\Controllers\Controller;
use Task\Application\Usecase\SearchUsecase;

/**
 * タスク Index Controller
 */
class TaskIndexController extends Controller
{
    /**
     * @param SearchUsecase $use_case
     */
    public function __construct(private SearchUsecase $use_case)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 検索処理
        $list = $this->use_case->invoke();

        // レスポンス
        return $list->toJson(JSON_UNESCAPED_UNICODE);
    }
}
