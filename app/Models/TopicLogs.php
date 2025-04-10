<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicLogs extends Model
{
    protected $table = 'topic_logs';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
