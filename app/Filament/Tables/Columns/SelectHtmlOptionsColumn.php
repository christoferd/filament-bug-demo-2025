<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\Column;
use Illuminate\Contracts\View\View;

class SelectHtmlOptionsColumn extends Column
{
    protected string $view = 'filament.tables.columns.select-html-options-column';

    public function render(): View
    {
        return parent::render()
            // ->with(['record'   => $this->getRecord(),])
            ;
    }

}
