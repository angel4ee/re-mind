<?php

namespace App\Filament\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * spatie/laravel-translatable auto-registers an `array` cast for every
 * translatable attribute, so `$record->attributesToArray()` returns the
 * *whole* {locale: value} map, not the active-locale value. Filament's own
 * EditAction/Repeater/table-search code paths already route through
 * makeFilamentTranslatableContentDriver() to resolve this, but
 * Filament\Resources\Pages\EditRecord::fillForm() (and refreshFormData())
 * call attributesToArray() directly — so without this override, opening the
 * edit page for any translated record hands the raw locale map to every
 * field. That's fatal for RichEditor (Tiptap chokes on a document with no
 * "content" key) and silently wrong for plain text fields.
 *
 * The same gap exists on save: EditRecord::handleRecordUpdate() calls
 * $record->update($data) directly, which writes through Eloquent's default
 * locale (app()->getLocale()) — NOT the locale the LocaleSwitcher has active.
 * Edit the "mk" tab, hit save, and the text silently lands in the "en" slot
 * while the "mk" value you were looking at doesn't change — indistinguishable
 * from the save doing nothing. The driver's updateRecord() calls
 * $record->setLocale($activeLocale) first so it writes to the right slot.
 *
 * Use on EditRecord pages only, alongside Translatable — CreateRecord and
 * ListRecords don't have fillForm()/refreshFormData()/handleRecordUpdate()
 * with this signature.
 */
trait FillsTranslatedFormData
{
    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        $this->form->fill($this->mutateFormDataBeforeFill(
            $this->getRecordAttributesForForm($this->getRecord())
        ));

        $this->callHook('afterFill');
    }

    public function refreshFormData(array $statePaths): void
    {
        $this->form->fillPartially(
            $this->mutateFormDataBeforeFill($this->getRecordAttributesForForm($this->getRecord())),
            $statePaths,
        );
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($driver = $this->makeFilamentTranslatableContentDriver()) {
            return $driver->updateRecord($record, $data);
        }

        $record->update($data);

        return $record;
    }

    protected function getRecordAttributesForForm(Model $record): array
    {
        return $this->makeFilamentTranslatableContentDriver()?->getRecordAttributesToArray($record)
            ?? $record->attributesToArray();
    }
}
