<?php

namespace App\Models;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Builder;

class Event extends Post
{
    protected static function booted(): void
    {
        parent::booted();

        static::addGlobalScope('type', fn (Builder $query) => $query->where('type', PostType::Event));

        static::creating(fn (Post $post) => $post->type = PostType::Event);
    }
}
