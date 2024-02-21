<?php

namespace DDD\App\Traits;

use DDD\Domain\Base\Statuses\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Models
use Illuminate\Support\Str;

trait IsStatusable
{
    protected static function bootIsStatusable(): void
    {
        static::creating(function (Model $model) {
            if (! $model->status_id) {
                $model->setStatus('needs-review');
            }
        });

        static::saving(function (Model $model) {
            if (request()->status) {
                $model->setStatus(request()->status);
            }
        });
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function setStatus($status)
    {
        if (! $status) {
            $this->status()->dissociate();

            return;
        }

        $this->status()->associate(
            $this->getWorkableStatus($status)
        );
    }

    private function getWorkableStatus($status)
    {
        // String
        if (is_string($status)) {
            return $this->getStatusModel($status);
        }

        // Integer
        if (is_int($status)) {
            return Status::find($status);
        }

        // Model
        if ($status instanceof Model) {
            return $status;
        }
    }

    private function getStatusModel(string $status)
    {
        return Status::where('slug', Str::slug($status))->first();
    }
}
