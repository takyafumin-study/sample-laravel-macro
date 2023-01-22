<?php

namespace Task\Presentation\Controller;

use App\Http\Controllers\Controller;
use Task\Application\Usecase\SearchUsecase;
use Task\Application\Usecase\StoreUsecase;

/**
 * タスク登録 Controller
 */
class TaskCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        StoreUsecase $use_case
    ) {
        $id = $use_case->invoke([
            'title' => 'テスト',
            'description' => 'テストデータ',
        ]);

        // レスポンス
        return $id;
    }
}
