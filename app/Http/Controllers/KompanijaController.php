<?php

namespace App\Http\Controllers;

use App\Models\Kompanija;
use Illuminate\Http\Request;

class KompanijaController extends Controller
{
    public function ucitavanje()
    {
        $kompanije = Kompanija::all();

        return response()->json([
            'kompanije' => $kompanije
        ]);
    }

    public function automobili_kompanije($id)
    {
        $automobili = Kompanija::find($id)->automobili()->get();

        return response()->json([
            'automobili' => $automobili
        ]);
    }
}
