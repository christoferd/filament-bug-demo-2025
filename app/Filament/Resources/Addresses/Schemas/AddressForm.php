<?php

namespace App\Filament\Resources\Addresses\Schemas;

use App\Models\City;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AddressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                             TextInput::make('address_to')
                                 ->columnSpan(2)
                                      ->required()
                                      ->default(''),
                             TextInput::make('street1')
                                      ->required()
                                      ->default(''),
                             TextInput::make('street2')
                                      ->default(''),
                             Select::make('city_id')
                                   ->label('City')
                                   ->options(City::orderBy('name')->pluck('name', 'id'))
                                   ->searchable()
                                   ->required()
                                   ->createOptionForm(
                                       [
                                           Section::make('Add Another City Name')
                                                  ->schema([
                                                               TextInput::make('name')->label('City Name')->required()
                                                           ])
                                       ]
                                   )
                                 // Yes, you can use createOptionForm() on a Select field within a JSON column without a direct relationship to the current model.
                                 // Implement createOptionUsing(): This is the most important part. Create a custom function that receives the form data
                                 // $data. Inside this function, write your custom logic to save the new city to its own model. The function must return the ID of the newly created record.
                                 // Automatically select the newly created city https://filamentphp.com/docs/4.x/forms/select#customizing-new-option-creation
                                   ->createOptionUsing(function(array $data)
                                 {
                                     $city = City::create($data);

                                     return $city->id;
                                 })
                                   ->default(null),
                             TextInput::make('postcode')
                                      ->required()
                                      ->default(''),
                         ]);
    }
}
