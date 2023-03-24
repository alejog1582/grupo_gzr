<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductoFidepuntosPlantillaExport implements FromView
{
    public function view(): View
    {
        return view('fidepuntos.exports.productoplantilla');
    }
}