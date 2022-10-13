<?php

namespace DDD\Domain\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// Domains
use DDD\Domain\Sites\Site;

// Traits
use DDD\App\Traits\IsTaggable;

class Page extends Model
{
    use HasFactory,
        SoftDeletes,
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
