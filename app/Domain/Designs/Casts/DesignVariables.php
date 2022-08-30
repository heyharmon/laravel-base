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
            'color_white' => '#ffffff',
            'color_black' => '#404040',
            'color_primary' => '#404040',
            'color_accent' => '#16e09a',
            'color_contrast_high' => '#404040',
            'color_contrast_higher' => '#404040',
            'color_background' => '#ffffff',
            'text_base_size' => '1.3',
            'font_primary' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => 'normal',
            ],
            'font_secondary' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => 'normal',
            ],
            'font_primary_weight' => 'normal',
            'font_secondary_weight' => 'normal',
            'btn_primary_text_color' => null,
            'btn_secondary_text_color' => null,
            'btn_tertiary_text_color' => null,
            'btn_radius' => '0.25',
            'btn_text_weight' => '400',
            'btn_text_transform' => 'none',
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
