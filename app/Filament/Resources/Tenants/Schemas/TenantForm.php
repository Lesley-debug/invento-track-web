<?php

namespace App\Filament\Resources\Tenants\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('plan_id')
                    ->label('Subscription Plan')
                    ->relationship('plan', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->native(false),

                TextInput::make('name')
                    ->label('Company Name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state));
                        }
                    }),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated from company name. Must be unique.')
                    ->rules(['alpha_dash']),

                FileUpload::make('logo_url')
                    ->label('Company Logo')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->directory('tenant-logos')
                    ->visibility('public')
                    ->nullable(),

                Select::make('currency')
                    ->label('Currency')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->default('USD')
                    ->options([
                        'USD' => 'USD — US Dollar',
                        'XAF' => 'XAF — Central African Franc',
                        'EUR' => 'EUR — Euro',
                        'GBP' => 'GBP — British Pound',
                        'NGN' => 'NGN — Nigerian Naira',
                        'KES' => 'KES — Kenyan Shilling',
                        'GHS' => 'GHS — Ghanaian Cedi',
                        'ZAR' => 'ZAR — South African Rand',
                        'TZS' => 'TZS — Tanzanian Shilling',
                        'UGX' => 'UGX — Ugandan Shilling',
                        'RWF' => 'RWF — Rwandan Franc',
                        'ETB' => 'ETB — Ethiopian Birr',
                        'CAD' => 'CAD — Canadian Dollar',
                        'AUD' => 'AUD — Australian Dollar',
                        'INR' => 'INR — Indian Rupee',
                        'CNY' => 'CNY — Chinese Yuan',
                        'AED' => 'AED — UAE Dirham',
                        'SAR' => 'SAR — Saudi Riyal',
                    ]),

                Select::make('timezone')
                    ->label('Timezone')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->default('UTC')
                    ->options([
                        'UTC'                     => 'UTC',
                        'Africa/Douala'           => 'Africa/Douala (WAT)',
                        'Africa/Lagos'            => 'Africa/Lagos (WAT)',
                        'Africa/Nairobi'          => 'Africa/Nairobi (EAT)',
                        'Africa/Johannesburg'     => 'Africa/Johannesburg (SAST)',
                        'Africa/Accra'            => 'Africa/Accra (GMT)',
                        'Africa/Cairo'            => 'Africa/Cairo (EET)',
                        'Africa/Abidjan'          => 'Africa/Abidjan (GMT)',
                        'Africa/Addis_Ababa'      => 'Africa/Addis_Ababa (EAT)',
                        'Africa/Dar_es_Salaam'    => 'Africa/Dar_es_Salaam (EAT)',
                        'Africa/Kampala'          => 'Africa/Kampala (EAT)',
                        'Africa/Kigali'           => 'Africa/Kigali (CAT)',
                        'Europe/London'           => 'Europe/London (GMT/BST)',
                        'Europe/Paris'            => 'Europe/Paris (CET)',
                        'Europe/Berlin'           => 'Europe/Berlin (CET)',
                        'America/New_York'        => 'America/New_York (EST)',
                        'America/Chicago'         => 'America/Chicago (CST)',
                        'America/Los_Angeles'     => 'America/Los_Angeles (PST)',
                        'America/Toronto'         => 'America/Toronto (EST)',
                        'Asia/Dubai'              => 'Asia/Dubai (GST)',
                        'Asia/Riyadh'             => 'Asia/Riyadh (AST)',
                        'Asia/Kolkata'            => 'Asia/Kolkata (IST)',
                        'Asia/Shanghai'           => 'Asia/Shanghai (CST)',
                        'Asia/Singapore'          => 'Asia/Singapore (SGT)',
                        'Australia/Sydney'        => 'Australia/Sydney (AEDT)',
                    ]),

                Select::make('subscription_status')
                    ->label('Subscription Status')
                    ->required()
                    ->native(false)
                    ->default('trial')
                    ->options([
                        'trial'     => 'Trial',
                        'active'    => 'Active',
                        'cancelled' => 'Cancelled',
                        'expired'   => 'Expired',
                    ]),

                DateTimePicker::make('trial_ends_at')
                    ->label('Trial Ends At')
                    ->nullable()
                    ->displayFormat('d M Y, H:i')
                    ->helperText('Leave blank if not on a trial period.'),
            ]);
    }
}
