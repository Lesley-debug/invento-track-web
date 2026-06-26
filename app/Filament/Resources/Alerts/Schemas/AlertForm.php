<?php

namespace App\Filament\Resources\Alerts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AlertForm
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
                    ->relationship('location', 'name'),
                Select::make('type')
                    ->options([
            'low_stock' => 'Low stock',
            'out_of_stock' => 'Out of stock',
            'expiry_soon' => 'Expiry soon',
            'expired' => 'Expired',
        ])
                    ->required(),
                Select::make('status')
                    ->options(['active' => 'Active', 'resolved' => 'Resolved'])
                    ->default('active')
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('triggered_at')
                    ->required(),
                DateTimePicker::make('resolved_at'),
            ]);
    }
}
