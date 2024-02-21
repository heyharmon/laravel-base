<?php

namespace DDD\Domain\Base\Teams;

use Illuminate\Database\Eloquent\Relations\HasMany;
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\HasSlug;
// Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use BelongsToOrganization,
        HasFactory,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Get the users who belong to this team.
     */
    public function users(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Users\User::class);
    }
}
