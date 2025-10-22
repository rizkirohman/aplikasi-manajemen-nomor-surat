<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->getStateUsing(fn ($record) => 
                        $record->hasRole('Super Admin') ? 'Super Admin' : 'Non Admin'
                    )
                    ->color(fn (string $state): string => match ($state) {
                        'Super Admin' => 'primary',  // 🟦 Blue for Super Admin
                        'Non Admin' => 'success',   // 🟩 Green for Non Admin
                        default => 'gray',
                    }),
                // TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
