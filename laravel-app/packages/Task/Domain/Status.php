<?php

namespace Task\Domain;

/**
 * ステータス
 */
enum Status: int
{
    /** 未着手 */
    case NONE = 0;

    /** 処理中 */
    case DOING = 1;

    /** 処理済 */
    case DONE = 9;

    /** クローズ */
    case CLOSE = 99;
}
