<?php

namespace DDD\Domain\Teams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;

class Team extends Model
{
    use HasFactory,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Get the users who belong to this team.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Users\User');
    }
}
