<?php

namespace DDD\Domain\Sites;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // protected $casts = [
    //     'meta' => 'json'
    // ];

    // public function pages()
    // {
    //     return $this->hasMany('DDD\Domain\Pages\Page');
    // }
}
