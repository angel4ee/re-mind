<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Concerns\Translatable;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['published_at'] = $data['is_draft'] ? null : ($data['published_at'] ?? now());
        unset($data['is_draft']);

        return $data;
    }
}
