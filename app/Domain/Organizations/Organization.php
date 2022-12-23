<?php

namespace DDD\Domain\Organizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// Traits
use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\HasMeta;

class Organization extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasComments,
        HasSlug,
        HasMeta;

    protected $guarded = ['id', 'slug'];

    /**
     * Crawls associated with the organization.
     *
     * @return hasMany
     */
    public function crawls()
    {
        return $this->hasMany('DDD\Domain\Crawls\Crawl');
    }

    /**
     * Last crawl associated with the organization.
     *
     * @return model
     */
    public function lastCrawl()
    {
        return $this->hasOne('DDD\Domain\Crawls\Crawl')->latest();
    }

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Users\User');
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations()
    {
        return $this->hasMany('DDD\Domain\Invitations\Invitation');
    }

    /**
     * Pages associated with the organization.
     *
     * @return hasMany
     */
    public function pages()
    {
        return $this->hasMany('DDD\Domain\Pages\Page');
    }

    /**
     * Redirects associated with the organization.
     *
     * @return hasMany
     */
    public function redirects()
    {
        return $this->hasMany('DDD\Domain\Redirects\Redirect');
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams()
    {
        return $this->hasMany('DDD\Domain\Teams\Team');
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany('DDD\Domain\Sites\Site');
    }

    /**
     * Designs associated with this organization.
     *
     * @return hasMany
     */
    public function designs()
    {
        return $this->hasMany('DDD\Domain\Designs\Design');
    }
}
