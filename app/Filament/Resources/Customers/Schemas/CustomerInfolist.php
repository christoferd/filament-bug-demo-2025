<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\City;
use App\Models\Customer;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        /** @var Customer $customer */
        $customer = $schema->getRecord();

        return $schema
            ->components([
                             Section::make('Customer Information')
                                    ->columns(3)
                                    ->columnSpan(2)
                                    ->schema([
                                                 TextEntry::make('user.name'),
                                                 TextEntry::make('Account Manager')
                                                          ->state($customer?->accountManager?->name ?: ''),
                                                 TextEntry::make('abn'),

                                                 TextEntry::make('company_name')->columnSpan(2),
                                                 TextEntry::make('brand_label'),

                                                 TextEntry::make('first_name'),
                                                 TextEntry::make('last_name'),

                                                 TextEntry::make('phone_1'),

                                                 TextEntry::make('tradeTerm.name')->label('Trade Terms'),
                                                 TextEntry::make('paymentTerm.name')->label('Payment Terms'),
                                                 TextEntry::make('phone_2'),

                                                 TextEntry::make('AddressSingleLine')
                                                          ->label('Company Address') // Sets the label
                                                          ->columnSpan(3),

                                                 TextEntry::make('website')->columnSpan(3),
                                                 IconEntry::make('is_active')
                                                          ->boolean(),
                                                 TextEntry::make('created_at')
                                                          ->dateTime(),
                                                 TextEntry::make('updated_at')
                                                          ->dateTime(),
                                             ]),

                             // -------------
                             Section::make('Emails')
                                    ->schema([
                                                 RepeatableEntry::make('emails')
                                                                ->schema([
                                                                             TextEntry::make('name'),
                                                                             TextEntry::make('email'),
                                                                         ])
                                                                ->columns(2)->columnSpan(2),

                                             ])->columnSpan(2),

                             // -------------
                             Section::make('Shipping Addresses')
                                    ->schema([
                                                 // RepeatableEntry::make('shipping_addresses')
                                                 //                ->hiddenLabel()
                                                 //                ->schema([
                                                 //                             TextEntry::make('address_to'),
                                                 //                             TextEntry::make('street1'),
                                                 //                             TextEntry::make('street2'),
                                                 //                             TextEntry::make('city_id')
                                                 //                               ->state(fn(Get $get): string => $get('city_id')) // <- HTTP ERROR 500
                                                 //                               //->state('some text') // <- this works
                                                 //                               //      ->state(fn(Get $get): string => 'some text') // <- this works
                                                 //                               // ->state(fn(Get $get): string => $get('shipping_addresses.city_id')) // <- Internal Server Error
                                                 //                               // ->state(fn($state): string => $state['city_id']) // <- HTTP ERROR 500
                                                 //                                      ->label('City'),
                                                 //                             TextEntry::make('postcode'),
                                                 //                         ])

                                                 RepeatableEntry::make('shipping_addresses')
                                                                ->hiddenLabel()
                                                                ->schema(function(Get $get, $state, $record, $model): array
                                                                {
                                                                    return [
                                                                        TextEntry::make('address_to'),
                                                                        TextEntry::make('street1'),
                                                                        TextEntry::make('street2'),
                                                                        TextEntry::make('city_id')
                                                                            ->state($get('city_id')) // <- this returns null or a blank string
                                                                            // ->state(\json_encode($state)) // <- this returns all of the shipping addresses
                                                                            // ->state(\json_encode($get)) // <- this returns an empty json object
                                                                            // ->state(\json_encode($record)) // <- this returns an all record data, including the shipping addresses
                                                                            ->state(\json_encode($model)) // <- this returns "App\\Models\\Customer"
                                                                                 ->label('City'),
                                                                        TextEntry::make('postcode'),
                                                                    ];
                                                                }
                                                                )

                                             ]
                                    )
                                    ->columns(2)->columnSpan(3),

                         ]);
    }
}
