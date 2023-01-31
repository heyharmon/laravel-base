<?php

namespace DDD\Domain\Base\Teams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\BelongsToOrganization;

class Team extends Model
{
    use HasFactory,
        HasSlug,
        BelongsToOrganization;

    protected $guarded = ['id', 'slug'];

    /**
     * Get the users who belong to this team.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Base\Users\User');
    }
}
