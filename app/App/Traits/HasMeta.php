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
    public function metas()
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
        return (boolean) $this->metas()->whereKey($key)->count();
    }

    /**
     * Retrieve a metadata item.
     * @param $key
     * @return Model
     */
     public function getMetadata($key)
     {
         $meta = $this->metas()->where('key', $key)->first();

         // return $meta;
         return json_decode($meta);
     }

   /**
    * Save or update meta of a Model.
    * @param $key
    * @param $value
    * @return mixed
    */
    public function saveMetadata($key, $value)
    {
        $meta = $this->metas()->where('key', $key)->first() ?: new Meta(['key' => $key]);

        // $meta->value = $value;
        $meta->value = json_encode($value);

        return $this->metas()->save($meta);
    }
}
