<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TreatmentsChart;
use App\Models\Bank;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;

class Settings extends Page implements HasForms, HasActions, HasTable
{
    use InteractsWithTable;

    public $defaultAction = 'onboarding';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit'),
            Action::make('delete')
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TreatmentsChart::class
        ];
    }
    public function getHeading(): string
    {
        return __('Custom Page Heading');
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->requiresConfirmation()
            ->action(fn () => $this->post->delete());
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Repeater::make('members')
                ->schema([
                    TextInput::make('name')->required(),
                    Select::make('role')
                        ->options([
                            'member' => 'Member',
                            'administrator' => 'Administrator',
                            'owner' => 'Owner',
                        ])
                        ->required(),
                ])
                ->columns(2)
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->query(Bank::query())
        ->columns([
            TextColumn::make('id'),
            TextColumn::make('nama_bank'),
        ])
        ->filters([
            SelectFilter::make('nama_bank')
            ->options([
                'MANDIRI' => 'MANDIRI',
                'BCA' => 'BCA   ',
            ])
        ])
        ->actions([])
        ->bulkActions([]);
    }
}
