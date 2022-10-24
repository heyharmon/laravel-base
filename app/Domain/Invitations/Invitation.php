<?php

namespace DDD\Domain\Invitations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Enums
use DDD\App\Enums\RoleEnum;

// Traits
use DDD\App\Traits\HasUuid;
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;

class Invitation extends Model
{
    use HasFactory,
        HasUuid,
        BelongsToOrganization,
        BelongsToUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'role' => RoleEnum::class,
        'registered_at' => 'datetime',
    ];

    /*
     * Get invite url
     */
    public function url()
    {
        return urldecode(env('APP_UI_URL') . '/' . $this->organization->slug . '/invitation/' . $this->uuid);
    }
}
