<?php

namespace App\Support\database\migrations;

use Illuminate\Database\Schema\Blueprint;

/**
 * Timestamp Trait
 */
trait TimestampTrait
{
    /**
     * Timestamp項目を追加する
     *
     * @param Blueprint $table テーブル
     * @return void
     */
    private function addTimestamps(Blueprint $table): void
    {
        $table->dateTime('created_at')->comment('作成日時');
        $table->unsignedBigInteger('created_by')->comment('作成者');
        $table->dateTime('updated_at')->comment('更新日時');
        $table->unsignedBigInteger('updated_by')->comment('更新者');
        $table->dateTime('deleted_at')->nullable()->comment('削除日時');
        $table->unsignedBigInteger('deleted_by')->nullable()->comment('削除者');
    }
}
