<?php

namespace Task\Domain\Entity;

use BackedEnum;
use InvalidArgumentException;
use Task\Domain\Status;

/**
 * タスク
 *
 * @property int|null $id
 * @property string $title
 * @property string $description
 * @property Status $status
 * @property int|null $assign_to
 */
class Task
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $description,
        private Status $status,
        private ?int $assign_to
    ) {
    }

    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            throw new InvalidArgumentException();
        }

        return $this->{$name};
    }

    /**
     * 変更
     *
     * @param array $attributes
     * @return Task
     */
    public function apply(array $attributes): Task
    {
        return new Task(
            $this->id,
            $attributes['title'],
            $attributes['description'] ?? $this->description,
            $this->status,
            $this->assign_to,
        );
    }

    /**
     * 配列に変換する
     *
     * @return array
     */
    public function toArray(): array
    {
        $properties = collect(get_object_vars($this));

        $list = [];
        foreach ($properties as $key => $value) {
            if ($key === 'id') {
                continue;
            }

            if ($value instanceof BackedEnum) {
                $list[$key] = $value->value;
                continue;
            }

            $list[$key] = $value;
        }

        return $list;
    }
}
