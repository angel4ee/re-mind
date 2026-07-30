<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PostType: string implements HasLabel
{
    case News = 'news';
    case Event = 'event';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::News => __('posts.type_news'),
            self::Event => __('posts.type_event'),
        };
    }
}
