<?php

namespace DDD\Domain\Designs\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DesignVariables implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $value = isset($value) ? json_decode($value, true) : [];

        $defaults = [
            'color_white' => '#fff',
            'color_black' => '#000',
            'color_primary' => '#000',
            'color_accent' => '#16e09a',
            'color_contrast_high' => '#000',
            'color_contrast_higher' => '#000',
            'color_background' => '#fff',
            'text_base_size' => '1.3',
            'font_primary' => 'Roboto Slab',
            'font_primary_weight' => '400',
            'font_secondary' => 'Inter',
            'font_secondary_weight' => '400',
            'button_radius' => '0.25',
        ];

        return array_merge($defaults, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (isset($value)) {
            return json_encode($value);
        }
    }
}
