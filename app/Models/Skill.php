<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'created_by', 'updated_by', 'deleted_by'];
    protected $dates = ['deleted_at'];
    public function candidate(): BelongsToMany
    {

        return $this->belongsToMany(
            Candidate::class,
            'skill_sets',
            'skill_id',
            'candidate_id'
        );
    }
}
