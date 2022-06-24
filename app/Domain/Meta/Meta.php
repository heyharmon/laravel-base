<?php

namespace DDD\Domain\Meta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function metable()
    {
        return $this->morphTo();
    }

    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['value'] = json_encode($value);
            return ;
        }

        $this->attributes['value'] = $value;
    }

    public function getValueAttribute($value)
    {
        $decodeValue = json_decode($value,true);

        if (is_array($decodeValue)) {
            return $decodeValue;
        }

        return $value;
    }
}
