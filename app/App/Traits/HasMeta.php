<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Plank\Metable\Metable;

trait HasMeta
{
    use Metable;

    protected static function bootHasMeta(): void
    {
        static::saved(function (Model $model) {
            $model->setMetaFromRequest(request()->input());
        });
    }

     /**
     * Set any meta from request
     * @return null
     */
    public function setMetaFromRequest(Array $input)
    {
        foreach ($input as $key => $value) {
            if (Str::startsWith($key, 'meta_')) {
                $this->setMeta($key, $value);
            }
        }
    }

   // 👇 My own Meta implementation
   //  /**
   //  * Get All Metadata using Polymorphic Relationship
   //  * @return mixed
   //  */
   //  public function metas()
   //  {
   //      return $this->morphMany(Meta::class, 'metable');
   //  }
   //
   //
   // /**
   //  * Check if a meta key already exist.
   //  * @param $key
   //  * @return bool
   //  */
   //  public function hasMetadata($key)
   //  {
   //      return (boolean) $this->metas()->whereKey($key)->count();
   //  }
   //
   //  /**
   //   * Retrieve a metadata item.
   //   * @param $key
   //   * @return Model
   //   */
   //   public function getMetadata($key)
   //   {
   //       $meta = $this->metas()->where('key', $key)->first();
   //
   //       // return $meta;
   //       return json_decode($meta);
   //   }
   //
   // /**
   //  * Save or update meta of a Model.
   //  * @param $key
   //  * @param $value
   //  * @return mixed
   //  */
   //  public function saveMetadata($key, $value)
   //  {
   //      $meta = $this->metas()->where('key', $key)->first() ?: new Meta(['key' => $key]);
   //
   //      // $meta->value = $value;
   //      $meta->value = json_encode($value);
   //
   //      return $this->metas()->save($meta);
   //  }
}
