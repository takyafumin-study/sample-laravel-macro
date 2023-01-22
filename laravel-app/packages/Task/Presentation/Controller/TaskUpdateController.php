<?php

namespace Task\Presentation\Controller;

use App\Http\Controllers\Controller;
use Task\Application\Usecase\UpdateUsecase;

/**
 * タスク更新 Controller
 */
class TaskUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        int $id,
        UpdateUsecase $use_case
    ) {
        $id = $use_case->invoke($id, [
            'title' => 'テスト1',
            'description' => 'テストデータ1',
        ]);

        // レスポンス
        return $id;
    }
}
