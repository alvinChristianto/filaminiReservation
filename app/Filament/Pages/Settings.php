<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit'),
            Action::make('delete')
        ];
    }
}
