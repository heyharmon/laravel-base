<?php

namespace DDD\Domain\Organizations;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use DDD\App\Traits\HasSlug;

class Organization extends Model
{
    use HasFactory,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Route key used to fetch resource
     *
     */

    // TODO: Rather than specifying the route key name here.
    // Specify the keyname to be used in the route.
    // This way you are not forced to use the specified keyname everywhere.
    // It also cleans up the model.
    // Do this for all models.
    // https://laravel.com/docs/8.x/routing#implicit-model-binding-scoping

    public function getRouteKeyName()
    {
        return 'slug';
    }

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
     * Organization belongs to many users via 'organization_user' table.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Cms\Domain\Users\User');
    }
}
