<?php

namespace App\Exports;

use App\Models\Deliver;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDeliver implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Deliver::all();
    }
}
