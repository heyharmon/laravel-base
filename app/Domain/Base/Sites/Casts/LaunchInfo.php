<?php

namespace DDD\Domain\Base\Sites\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class LaunchInfo implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        $value = isset($value) ? json_decode($value, true) : [];

        $defaults = [
            'launch_date' => null,
            'freeze_date' => null,
            'dev_domain' => null,
            'prod_domain' => null,
            'prod_ip' => null,
            'notes' => null,
        ];

        return array_merge($defaults, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (isset($value)) {
            return json_encode($value);
        }
    }
}
