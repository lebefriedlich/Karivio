<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutIncrementing;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('cvs')]
#[Fillable([
    'user_id',
    'full_name',
    'email',
    'phone',
    'location',
    'professional_summary',
    'linkedin_url',
    'portfolio_url',
    'work_experiences',
    'technical_skills',
    'hard_skills',
    'soft_skills',
    'education',
    'organization_experiences',
    'languages',
    'assistance_experiences',
])]
#[WithoutIncrementing]
class Cv extends Model
{
    use HasUuids;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'work_experiences' => 'array',
        'technical_skills' => 'array',
        'hard_skills' => 'array',
        'soft_skills' => 'array',
        'education' => 'array',
        'organization_experiences' => 'array',
        'languages' => 'array',
        'assistance_experiences' => 'array',
    ];

    /**
     * Get the user that owns the CV.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
