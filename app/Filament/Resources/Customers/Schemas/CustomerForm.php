<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Filament\Resources\Addresses\Schemas\AddressForm;
use App\Libraries\FFormLib;
use App\Libraries\SelectOptionsLib;
use App\Models\Customer;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;

class CustomerForm
{
    public static function configure(Schema $schema, ?Customer $customer = null): Schema
    {
        return $schema
            ->components(
                [
                    TextInput::make('first_name')
                             ->required()
                             ->default(''),
                    TextInput::make('last_name')
                             ->required()
                             ->default(''),

                    // ------------
                    // https://filamentphp.com/docs/4.x/schemas/sections#introduction
                    // You can also use a section without a header, which just wraps the components in a simple card:
                    Section::make('Shipping Addresses')
                           ->description('Multiple shipping addresses. The default shipping address is the first one, at the top.')
                           ->schema(
                               [
                                   Repeater::make('shipping_addresses')
                                       // hide label
                                           ->hiddenLabel()
                                           ->schema(
                                               AddressForm::configure($schema)->getComponents()
                                           )
                                       // Allow sorting so that the default address is at the top
                                           ->reorderable(true)
                                       // Allow delete button
                                           ->deletable(true)
                                       // - Confirming repeater actions with a modal https://filamentphp.com/docs/4.x/forms/repeater#confirming-repeater-actions-with-a-modal
                                           ->deleteAction(
                                           fn(Action $action) => $action->requiresConfirmation(),
                                       )
                                       // Layout
                                           ->columns(3),
                               ]
                           )->columnSpan(3)
                    ,

                    // Chris D. 25-Sep-2025
                    Section::make('Bug Test')
                           ->description('Issue: Fieldset inlineLabel SelectInput not middle vertical aligned.')
                           ->schema(
                               [
                                   Fieldset::make('Testing')->schema([
                                                                         TextInput::make('Test')->default('Hello'),
                                                                         Select::make('SelectOption')->options(['One', 'Two', 'Three', 'Four', 'Five', 'Six'])
                                                                               ->required(),
                                                                     ])->inlineLabel()
                                           ->columns(3)
                                           ->columnSpanFull(),
                               ]
                           )->columnSpanFull()
                    ,

                ]
            );
    }

}
