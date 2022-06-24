<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;

use DDD\Domain\Meta\Meta;

trait HasMeta
{
    protected static function bootHasMeta(): void
    {
        static::created(function (Model $model) {
            $meta = request()->meta;

            if ($meta) {
                foreach ($meta as $key => $value) {
                    $model->saveMetadata($key, $value);
                }
            }
        });
    }

   /**
    * Get All Metadata using Polymorphic Relationship
    * @return mixed
    */
    public function meta()
    {
        return $this->morphMany(Meta::class, 'metable');
    }


   /**
    * Check if a meta key already exist.
    * @param $key
    * @return bool
    */
    public function hasMetadata($key)
    {
        return (boolean) $this->meta()->whereKey($key)->count();
    }

   /**
    * Retrieve a meta of a meta.
    * @param $key
    * @return mixed
    */
    public function getMetadata($key)
    {
        return $this->meta()->whereKey($key)->first()->value;
    }

   /**
    * Save or update meta of a Model.
    * @param $key
    * @param $value
    * @return mixed
    */
    public function saveMetadata($key, $value)
    {
        $meta = $this->meta()->whereKey($key)->first() ?: new Meta(['key' => $key]);

        $meta->value = $value;

        return $this->meta()->save($meta);
    }
}
