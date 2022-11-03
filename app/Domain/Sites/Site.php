<?php

namespace DDD\Domain\Sites;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Casts
use DDD\Domain\Sites\Casts\LaunchInfo;

// Traits
// use DDD\App\Traits\BelongsToOrganization;

class Site extends Model
{
    use HasFactory;
        // BelongsToOrganization;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'launch_info' => LaunchInfo::class,
    ];

    /**
     * Get the pages associated with this site.
     *
     * @return hasMany
     */
    public function pages()
    {
        return $this->hasMany('DDD\Domain\Pages\Page');
    }

    /**
     * Get the crawls associated with this site.
     *
     * @return hasMany
     */
    public function crawls()
    {
        return $this->hasMany('DDD\Domain\Crawls\Crawl');
    }

    public function lastCrawl()
    {
        return $this->hasOne('DDD\Domain\Crawls\Crawl')->latest();
    }
}
