<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'salary',
        'job_type',
        'description',
        'logo',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
