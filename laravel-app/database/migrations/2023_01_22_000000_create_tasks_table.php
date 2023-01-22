<?php

use App\Support\database\migrations\TimestampTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use TimestampTrait;

    private const TABLE_NAME = 'tasks';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id()->autoIncrement()->comment('タスクID');
            $table->string('title', 20)->comment('タスク名');
            $table->string('description', 255)->comment('タスク詳細');
            $table->smallInteger('status')->comment('タスク状態');
            $table->unsignedBigInteger('assign_to')->nullable()->comment('タスク担当者');
            $this->addTimestamps($table);

            // 外部キー
            $table->foreign('assign_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
