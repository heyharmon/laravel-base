<?php

namespace DDD\Domain\Pages;

use DDD\Domain\Sites\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // protected $casts = [
    //     'meta' => 'json'
    // ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
