<?php

namespace Quadram\LaravelUtils\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Quadram\LaravelUtils\Classes\Copy;

class CopiesExport implements FromCollection
{
    public function collection()
    {
        $collection = collect(Copy::toArrayWithHeaders());

        return $collection;
    }
}
