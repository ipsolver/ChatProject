<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;
use RTippin\Messenger\Traits\Search;
use RTippin\Messenger\Traits\Uuids;

/**
 * @property string      $id
 * @property string      $thread_id
 * @property string      $owner_id
 * @property string      $owner_type
 * @property string|null $body
 * @property int         $type     0=text 1=image 2=file 3=audio 4=video
 * @property \Carbon\Carbon|null $edited_at
 * @property \Carbon\Carbon|null $created_at
 *
 * @method static Builder|Message text()
 * @method static Builder|Message media()
 * @mixin \Eloquent
 */
class Message extends Model
{
    use HasFactory, Search, Uuids;

    protected $guarded = [];

    protected $dates = [
        'edited_at',
    ];

    /* ==== Relations ==== */

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /* ==== Scopes ==== */

    public function scopeText(Builder $q): Builder
    {
        return $q->where('type', 0);
    }

    public function scopeMedia(Builder $q): Builder
    {
        return $q->whereIn('type', [1, 2, 3, 4]);
    }
}
