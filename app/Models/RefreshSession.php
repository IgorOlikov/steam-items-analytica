<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefreshSession extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'refresh_sessions';

    protected $fillable = ['id','user_id','refresh_token','user_agent','ip','expires_in'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
