<?php

namespace App\Models;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Builder;

class News extends Post
{
    protected static function booted(): void
    {
        parent::booted();

        static::addGlobalScope('type', fn (Builder $query) => $query->where('type', PostType::News));

        static::creating(fn (Post $post) => $post->type = PostType::News);
    }
}
