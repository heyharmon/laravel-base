<?php

namespace DDD\Domain\Base\Users;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Base\Users\Enums\RoleEnum;
use DDD\App\Traits\BelongsToOrganization;

class User extends Authenticatable
{
    use BelongsToOrganization,
        HasApiTokens,
        HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',           // TODO: Remove
        'organization_id', // TODO: Remove
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'role' => RoleEnum::class,
        'email_verified_at' => 'datetime',
    ];

    // TODO: Move to a one to many (user belongs to many orgs)
    public function organization(): BelongsTo
    {
        return $this->belongsTo(\DDD\Domain\Base\Organizations\Organization::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Files\File::class);
    }
}
