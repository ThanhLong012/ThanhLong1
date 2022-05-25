<?php

namespace App\Exports;

use App\Models\Receive;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportReceive implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Receive::all();
    }
}
