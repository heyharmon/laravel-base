<?php

namespace DDD\App\Traits;

use ArrayAccess;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use InvalidArgumentException;

trait IsSortable
{
    protected static function bootIsSortable(): void
    {
        static::creating(function (Model $model) {
            $model->setHighestOrderNumber();
        });

        // static::created(function (Model $model) {
        //     $model->reorder(0);
        // });

        // static::deleting(function (Model $model) {
        //     $model->order = 0;
        // });
    }

    public function setHighestOrderNumber(): void
    {
        $this->order = $this->buildSortQuery()->max('order') + 1;
    }

    public function reorder(string $order)
    {
        // List related records by id
        $ids = $this->buildSortQuery()->pluck('id');

        // Remove then add self to list at new index
        $ids = $ids->reject($this->id);
        $ids->splice($order - 1, 0, $this->id);

        // Set new order for all records in list
        $this->setNewOrder($ids);
    }

    public function buildSortQuery(): Collection
    {
        // Check if model is nestable
        if (array_key_exists('parent_id', $this->attributes)) {
            if ($this->parent_id) {
                // Model has siblings to be ordered amongst
                return $this
                    ->siblings()
                    ->orderBy('order')
                    ->get();
            } else {
                // Model is a top level parent to be modeled amongst
                return static::query()
                    ->where('organization_id', $this->organization->id)
                    ->where('parent_id', null)
                    ->orderBy('order')
                    ->get();
            }
        }

        return static::query()
            ->where('organization_id', $this->organization->id)
            ->orderBy('order')
            ->get();
    }

    public static function setNewOrder($ids, int $startOrder = 1, ?string $primaryKeyColumn = null): void
    {
        if (! is_array($ids) && ! $ids instanceof ArrayAccess) {
            throw new InvalidArgumentException('You must pass an array or ArrayAccess object to setNewOrder');
        }

        $model = new static();

        if (is_null($primaryKeyColumn)) {
            $primaryKeyColumn = $model->getKeyName();
        }

        foreach ($ids as $id) {
            static::withoutGlobalScope(SoftDeletingScope::class)
                ->where($primaryKeyColumn, $id)
                ->update(['order' => $startOrder++]);
        }
    }
}
