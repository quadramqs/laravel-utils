<?php

namespace Quadram\LaravelUtils\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Quadram\LaravelUtils\Classes\Copy;

class CopiesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        Copy::fromArray($rows);
    }
}
