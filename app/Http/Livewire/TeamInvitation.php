<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Tables\Table;
use App\Models\TeamInvitation as TeamInvitationModel;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class TeamInvitation extends Component implements HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                TeamInvitationModel::query()
                    ->where('team_id', Filament::getTenant()->id)
            )
            ->columns([
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Sent')
                    ->formatStateUsing(function ($state) {
                        return $state->diffForHumans();
                    }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.team-invitation');
    }
}
