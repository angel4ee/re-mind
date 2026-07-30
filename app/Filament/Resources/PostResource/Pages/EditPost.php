<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Concerns\FillsTranslatedFormData;
use App\Filament\Concerns\Translatable;
use App\Filament\Resources\PostResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    use FillsTranslatedFormData, Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->localeSwitcherAction(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['published_at'] = $data['is_draft'] ? null : ($data['published_at'] ?? now());
        unset($data['is_draft']);

        return $data;
    }
}
