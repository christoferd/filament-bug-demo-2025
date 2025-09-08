<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

class CardFileResource extends \Filament\Resources\Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationSort(): ?int
    {
        return config('app.nav_sort.'.\get_called_class(), 100);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Card Files';
    }
}
