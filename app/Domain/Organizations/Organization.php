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
