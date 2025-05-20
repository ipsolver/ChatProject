<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use RTippin\Messenger\Traits\Search;
use RTippin\Messenger\Traits\Uuids;

/**
 * @property string      $id
 * @property string|null $subject
 * @property int         $type      1 = private, 2 = group
 * @property bool        $locked
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @method static Builder|Thread private()
 * @method static Builder|Thread group()
 * @mixin \Eloquent
 */
class Thread extends Model
{
    use HasFactory, Search, Uuids;

    protected $guarded = [];

    protected $casts = [
        'locked' => 'boolean',
    ];

    /* ==== Scopes ==== */

    public function scopePrivate(Builder $query): Builder
    {
        return $query->where('type', 1);
    }

    public function scopeGroup(Builder $query): Builder
    {
        return $query->where('type', 2);
    }
}
