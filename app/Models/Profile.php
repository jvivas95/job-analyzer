<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Override;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'title',
        'location',
        'email',
        'phone',
        'linkedin',
        'website',
        'secondary_url',
        'summary',
        'experience',
        'projects',
        'skills',
        'education',
        'soft_skills',
        'languages',
    ];

    #[Override]
    protected function casts(): array
    {
        return[
            'skills' => 'array',
            'experience' => 'array',
            'projects' => 'array',
            'education' => 'array',
            'soft_skills' => 'array',
            'languages' => 'array'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
