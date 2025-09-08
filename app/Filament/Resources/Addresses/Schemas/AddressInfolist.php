<?php

namespace App\Filament\Resources\Addresses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AddressInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('address_to'),
                TextEntry::make('street1'),
                TextEntry::make('street2'),
                TextEntry::make('city.name'),
                TextEntry::make('postcode'),
            ]);
    }
}
