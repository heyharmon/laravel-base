<?php

namespace DDD\Domain\Base\Teams;

use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
