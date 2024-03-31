<?php

namespace DDD\Domain\Base\Invitations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Base\Users\Enums\RoleEnum;
use DDD\App\Traits\HasUuid;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;

class Invitation extends Model
{
    use BelongsToOrganization,
        BelongsToUser,
        HasFactory,
        HasUuid;

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
        return urldecode(env('APP_UI_URL').'/'.$this->organization->slug.'/invitations/'.$this->uuid);
    }
}
