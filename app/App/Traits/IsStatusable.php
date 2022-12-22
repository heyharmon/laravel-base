<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Domains
use DDD\Domain\Statuses\Status;

trait IsStatusable
{
    protected static function bootIsStatusable(): void
    {
        static::saving(function (Model $model) {
            if (request()->status) {
                $model->setStatus(request()->status);
            }
        });
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function setStatus($status)
    {
        if (!$status) {
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
