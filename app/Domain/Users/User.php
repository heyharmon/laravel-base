<?php

namespace DDD\Domain\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Traits
use Laravel\Sanctum\HasApiTokens;
use DDD\App\Traits\BelongsToOrganization;

// Scopes
// use DDD\App\Scopes\OrganizationScope;

class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        HasApiTokens,
        BelongsToOrganization;

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
        'email_verified_at' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany('DDD\Domain\Comments\Comment');
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new OrganizationScope);
    // }
}
