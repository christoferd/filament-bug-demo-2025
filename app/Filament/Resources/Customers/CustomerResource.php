<?php

namespace App\Filament\Resources\Customers;

use App\Filament\Resources\CardFileResource;
use App\Filament\Resources\Customers\Pages\CreateCustomer;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\ViewCustomer;
use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\Filament\Resources\Customers\Schemas\CustomerInfolist;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use App\Models\Customer;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CustomerResource extends CardFileResource
{
    protected static ?string $model = Customer::class;

    protected static ?string $recordTitleAttribute = 'company_name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components(
            CustomerForm::configure($schema)->getComponents()
        )->extraAttributes(
            ['class' => 'mx-auto w-3xl',]
        );
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components(
            CustomerInfolist::configure($schema)->getComponents()
        )->extraAttributes(
            ['class' => 'mx-auto w-3xl',]
        );
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'view'   => ViewCustomer::route('/{record}'),
            'edit'   => EditCustomer::route('/{record}/edit'),
        ];
    }

}
