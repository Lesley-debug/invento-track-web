<?php

namespace App\Filament\Resources\Plans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Plan Name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. Starter, Growth, Enterprise'),

                TextInput::make('price_monthly')
                    ->label('Monthly Price (USD)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),

                TextInput::make('price_yearly')
                    ->label('Yearly Price (USD)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),

                TextInput::make('max_users')
                    ->label('Max Users')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(2),

                TextInput::make('max_products')
                    ->label('Max Products')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(500),

                TextInput::make('max_locations')
                    ->label('Max Locations')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(1),

                Toggle::make('has_api_access')
                    ->label('API Access')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true),
            ]);
    }
}
