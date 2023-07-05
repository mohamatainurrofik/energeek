<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['job_id', 'name', 'email', 'phone', 'year', 'created_by', 'updated_by', 'deleted_by'];
    protected $dates = ['deleted_at'];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function skill(): BelongsToMany
    {
        return $this->belongsToMany(
            Skill::class,
            'skill_sets',
            'candidate_id',
            'skill_id'
        );
    }
}
