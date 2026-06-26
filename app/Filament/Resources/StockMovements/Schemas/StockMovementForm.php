<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tenant_id')
                    ->relationship('tenant', 'name')
                    ->required(),
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                Select::make('location_id')
                    ->relationship('location', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('reference_id'),
                TextInput::make('reference_type'),
                Select::make('type')
                    ->options([
            'in' => 'In',
            'out' => 'Out',
            'adjustment' => 'Adjustment',
            'transfer_in' => 'Transfer in',
            'transfer_out' => 'Transfer out',
        ])
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('unit_cost')
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
}
