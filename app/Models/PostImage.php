<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class PostImage extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['alt'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
