<?php

namespace App\Filament\Resources\PoItems\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PoItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('purchase_order_id')
                    ->relationship('purchaseOrder', 'id')
                    ->required(),
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('quantity_ordered')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity_received')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unit_cost')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                DatePicker::make('expiry_date'),
            ]);
    }
}
