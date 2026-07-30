<?php

namespace App\Filament\Concerns;

use App\Filament\SpatieTranslatableContentDriver;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Illuminate\Support\Js;
use Livewire\Attributes\Url;

trait Translatable
{
    #[Url]
    public ?string $activeLocale = null;

    public function getFilamentTranslatableContentDriver(): ?string
    {
        return SpatieTranslatableContentDriver::class;
    }

    public function getActiveSchemaLocale(): ?string
    {
        return $this->activeLocale ??= app()->getLocale();
    }

    public function getActiveTableLocale(): ?string
    {
        return $this->activeLocale ??= app()->getLocale();
    }

    protected function localeSwitcherAction(): Action
    {
        return Action::make('locale')
            ->label(fn (): string => config('locales')[$this->getActiveSchemaLocale()] ?? $this->getActiveSchemaLocale())
            ->icon('heroicon-m-language')
            ->color('gray')
            ->schema([
                Select::make('locale')
                    ->label(__('posts.locale'))
                    ->options(config('locales'))
                    ->default(fn (): ?string => $this->getActiveSchemaLocale())
                    ->required(),
            ])
            ->action(function (array $data): void {
                // request()->fullUrlWithQuery() reflects the Livewire AJAX
                // endpoint (/livewire/update) during an action call, not the
                // page the user is looking at — redirecting to that sends a
                // GET to a POST-only route and 405s. window.location is the
                // only thing that reliably knows the real page URL here.
                $this->js(
                    'let url = new URL(window.location.href);'
                    .'url.searchParams.set("activeLocale", '.Js::from($data['locale']).');'
                    .'window.location.href = url.toString();'
                );
            });
    }
}
