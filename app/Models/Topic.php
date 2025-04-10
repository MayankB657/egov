<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $table = 'topic';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function mediafiles(): HasMany
    {
        return $this->hasMany(TopicFiles::class, 'topic_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(TopicLogs::class, 'topic_id');
    }
}
