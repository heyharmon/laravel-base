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

    // TODO: Associate with a user
    // /**
    //  * Get the user who owns this organization.
    //  *
    //  * @return BelongsTo
    //  */
    // public function user()
    // {
    //     return $this->belongsTo('Cms\Domain\Users\User');
    // }

    /**
     * Get the users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Users\User');
    }

    /**
     * Get the teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams()
    {
        return $this->hasMany('DDD\Domain\Teams\Team');
    }

    /**
     * Get the files associated with this organization.
     *
     * @return hasMany
     */
    public function files()
    {
        return $this->hasMany('DDD\Domain\Files\File');
    }

    /**
     * Get the sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany('DDD\Domain\Sites\Site');
    }
}
