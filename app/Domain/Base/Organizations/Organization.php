<?php

namespace DDD\Domain\Base\Organizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// Traits
use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasSlug;

class Organization extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasComments,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Base\Users\User');
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations()
    {
        return $this->hasMany('DDD\Domain\Base\Invitations\Invitation');
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams()
    {
        return $this->hasMany('DDD\Domain\Base\Teams\Team');
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany('DDD\Domain\Base\Sites\Site');
    }
}
