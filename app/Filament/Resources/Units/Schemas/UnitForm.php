<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tenant_id')
                    ->relationship('tenant', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->label('Unit Name')
                    ->maxLength(255)
                    ->placeholder('e.g. Kilogram, Liter, Piece')
                    ->required(),
                TextInput::make('abbreviation')
                    ->label('Abbreviation')
                    ->maxLength(50)
                    ->placeholder('e.g. kg, L, pc')
                    ->required(),
            ]);
    }
}
