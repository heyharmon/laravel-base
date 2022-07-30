<?php

namespace DDD\Domain\Sites;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

// Traits
// use DDD\App\Traits\BelongsToOrganization;

// Models
use DDD\Domain\Pages\Page;

class Site extends Model
{
    use HasFactory;
        // BelongsToOrganization;

    protected $guarded = [
        'id',
    ];

    /**
     * Get the pages associated with this site.
     *
     * @return hasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Get the crawls associated with this site.
     *
     * @return hasMany
     */
    public function crawls()
    {
        return $this->hasMany('DDD\Domain\Sites\Crawls\Crawl');
    }

    public function lastCrawl()
    {
        return $this->hasOne('DDD\Domain\Sites\Crawls\Crawl')->latest();
    }

    // protected function lastCrawl(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value,
    //     );
    // }
}
