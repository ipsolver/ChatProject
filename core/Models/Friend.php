<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use RTippin\Messenger\Traits\Uuids;

/**
 * @property string $id
 * @property string $owner_id
 * @property string $friend_id
 * @property bool   $accepted
 * @property \Carbon\Carbon|null $created_at
 *
 * @method static Builder|Friend pending()
 * @method static Builder|Friend accepted()
 * @mixin \Eloquent
 */
class Friend extends Model
{
    use HasFactory, Uuids;

    protected $guarded = [];

    protected $casts = [
        'accepted' => 'boolean',
    ];

    /* ==== Scopes ==== */
    public function scopePending(Builder $q): Builder
    {
        return $q->where('accepted', false);
    }

    public function scopeAccepted(Builder $q): Builder
    {
        return $q->where('accepted', true);
    }
}
