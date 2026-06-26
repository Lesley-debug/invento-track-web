<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tenant_id')
                    ->searchable()
                    ->preload()
                    ->relationship('tenant', 'name')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->label('Product Name')
                    ->maxLength(255)
                    ->placeholder('e.g. iPhone 13, Samsung Galaxy S21, MacBook Pro')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU (Internal Code)')
                    ->maxLength(255)
                    ->placeholder('e.g. PROD-001, IPHONE-13-256GB')
                    ->required()
                    ->unique(ignoreRecord: true), // unique per company/tenant

                TextInput::make('barcode')
                    ->label('Barcode (EAN/UPC)')
                    ->maxLength(255)
                    ->placeholder('e.g. 5449000050127')
                    ->nullable(), // optional
            Textarea::make('description')
                    ->label('Description')
                    ->maxLength(1000)
                    ->placeholder('e.g. A high-end smartphone with advanced features.')
                    ->columnSpanFull(),
                FileUpload::make('image_url')
                    ->label('Product Image')
                    ->imagePreviewHeight('250')
                    ->imageResizeMode('cover')
                    ->image(),
                TextInput::make('cost_price')
                    ->required()
                    ->label('Cost Price (USD)')
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('selling_price')
                    ->label('Selling Price (USD)')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('min_stock')
                    ->label('Minimum Stock Level')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),

                TextInput::make('max_stock')
                    ->label('Maximum Stock Level')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Toggle::make('track_expiry')
                    ->label('Track Expiry Date')
                    ->default(true),

                Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true),
            ]);
    }
}
