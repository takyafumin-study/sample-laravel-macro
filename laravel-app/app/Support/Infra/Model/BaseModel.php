<?php

namespace App\Support\Infra\Model;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * Abstract Eloquent Model
 *
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 */
class BaseModel extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * Event Hooks
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // insert
        static::creating(function ($model) {
            $now = CarbonImmutable::now();
            $model->created_at = $now;
            $model->updated_at = $now;

            $attributes = $model->getAttributesForInsert();
            $model->created_by = $model::getCreatedBy($attributes);
            $model->updated_by = $model::getUpdatedBy($attributes);
        });

        // update
        static::updating(function ($model) {
            $now = CarbonImmutable::now();
            $model->updated_at = $now;

            $dirty = $model->getDirty();
            $model->updated_by = $model::getUpdatedBy($dirty);
        });
    }

    /**
     * Eloquent Builder を返却する
     *
     * @param \Illuminate\Database\Query\Builder  $query
     * @return void
     */
    public function newEloquentBuilder($query)
    {
        return new CustomBuilder($query);
    }

    /**
     * Insert
     *
     * @param array $attributes
     * @return void
     */
    public static function insert(array $attributes)
    {
        $now = CarbonImmutable::now();
        $attributes['created_at'] = $now;
        $attributes['updated_at'] = $now;

        $attributes['created_by'] = self::getCreatedBy($attributes);
        $attributes['updated_by'] = self::getUpdatedBy($attributes);

        return (new static())->forwardCallTo((new static())->newQuery(), 'insert', [$attributes]);
    }

    /**
     * created_byを返却する
     *
     * @param array $attributes
     * @return integer
     */
    private static function getCreatedBy(array $attributes): int
    {
        if (isset($attributes['created_by'])) {
            return $attributes['created_by'];
        }

        return auth()->id ?? 0;
    }

    /**
     * updated_byを返却する
     *
     * @param array $attributes
     * @return integer
     */
    private static function getUpdatedBy(array $attributes): int
    {
        if (isset($attributes['updated_by'])) {
            return $attributes['updated_by'];
        }

        return auth()->id ?? 0;
    }
}
