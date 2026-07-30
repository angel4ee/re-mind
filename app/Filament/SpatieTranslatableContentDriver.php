<?php

namespace App\Filament;

use Filament\Support\Contracts\TranslatableContentDriver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Bridges Filament v4's translatable-content extension point to
 * spatie/laravel-translatable. Filament v4 dropped the old
 * filament/spatie-laravel-translatable-plugin (abandoned, Filament v3 only)
 * in favour of this interface with no bundled implementation.
 */
class SpatieTranslatableContentDriver implements TranslatableContentDriver
{
    public function __construct(protected string $activeLocale) {}

    public function isAttributeTranslatable(string $model, string $attribute): bool
    {
        return (new $model)->isTranslatableAttribute($attribute);
    }

    public function getRecordAttributesToArray(Model $record): array
    {
        $attributes = $record->attributesToArray();

        foreach ($record->getTranslatableAttributes() as $attribute) {
            $attributes[$attribute] = $record->getTranslation($attribute, $this->activeLocale, useFallbackLocale: false);
        }

        return $attributes;
    }

    public function makeRecord(string $model, array $data): Model
    {
        $record = new $model;
        $record->setLocale($this->activeLocale);
        $record->fill($data);

        return $record;
    }

    public function setRecordLocale(Model $record): Model
    {
        return $record->setLocale($this->activeLocale);
    }

    public function updateRecord(Model $record, array $data): Model
    {
        $record->setLocale($this->activeLocale);
        $record->fill($data);
        $record->save();

        return $record;
    }

    public function applySearchConstraintToQuery(Builder $query, string $column, string $search, string $whereClause, ?bool $isSearchForcedCaseInsensitive = null): Builder
    {
        return $query->{$whereClause}($column.'->'.$this->activeLocale, 'like', '%'.$search.'%');
    }
}
