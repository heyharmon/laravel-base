<?php

namespace DDD\Domain\Pages;

use DDD\Domain\Sites\Site;
use DDD\App\Traits\IsTaggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory,
        IsTaggable;

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
