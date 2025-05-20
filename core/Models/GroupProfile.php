<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RTippin\Messenger\Traits\Uuids;

/**
 * @property string $id
 * @property string $thread_id
 * @property string $avatar       Path to group image
 * @property string $about
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @mixin \Eloquent
 */
class GroupProfile extends Model
{
    use HasFactory, Uuids;

    protected $guarded = [];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
