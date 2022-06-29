<?php

namespace DDD\Domain\Sites;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
// use DDD\App\Traits\BelongsToOrganization;

// Models
use DDD\Domain\Pages\Page;

class Site extends Model
{
    use HasFactory;
        // BelongsToOrganization;

    protected $guarded = [
        'id',
    ];

    // protected $casts = [
    //     'meta' => 'json'
    // ];

    /**
     * Get the pages associated with this site.
     *
     * @return hasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
