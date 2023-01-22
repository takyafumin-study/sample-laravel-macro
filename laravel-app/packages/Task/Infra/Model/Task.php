<?php

namespace Task\Infra\Model;

use App\Support\Infra\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Task Model
 *
 * @property int|null $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int|null $assign_to
 */
class Task extends BaseModel
{
    use HasFactory;
}
