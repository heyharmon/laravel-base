<?php

namespace DDD\Domain\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Enums
use DDD\Domain\Users\Enums\UserRoleEnum;

// Traits
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;

class UserInvitation extends Model
{
    use HasFactory,
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
        'role' => UserRoleEnum::class,
        'registered_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->generateToken();
        });
    }

    /*
     * Store a random invitation token on model
     */
    public function generateToken()
    {
        $this->invitation_token = substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }

    /*
     * Get invite url
     */
    public function url()
    {
        return urldecode(env('APP_UI_URL') . '?invitation_token=' . $this->invitation_token);
    }
}
