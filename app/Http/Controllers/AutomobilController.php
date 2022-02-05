<?php

namespace App\Http\Controllers;

use App\Models\Automobil;

use App\Models\Kompanija;
use Illuminate\Http\Request;

class AutomobilController extends Controller
{
    public function ucitavanje()
    {
        $automobili = Automobil::all();

        return response()->json([
            'automobili' => $automobili
        ]);
    }

    public function izmena(Request $request, $id)
    {
        $snaga = $request->input('snaga');
        $potrosnja = $request->input('potrosnja');
        Automobil::where('id', $id)->update(['snaga' => $snaga, 'potrosnja' => $potrosnja]);
        return response()->json([
            'message' => true,
        ]);
    }

    public function dodavanje(Request $request)
    {
        $model = $request->input('model');
        $snaga = $request->input('snaga');
        $potrosnja = $request->input('potrosnja');
        $kompanija_id = $request->input('kompanija_id');

        Automobil::insert([
            'snaga' => $snaga,
            'model' => $model,
            'potrosnja' => $potrosnja,
            'kompanija_id' => $kompanija_id
        ]);
        Kompanija::find($kompanija_id)->increment('broj_automobila', 1);
        return response()->json([
            'message' => true,
        ]);
    }

    public function brisanje($id)
    {
        $kompanija = Automobil::find($id)->kompanija;
        if ($kompanija) {
            $kompanija->decrement('broj_automobila', 1);
        }
        Automobil::find($id)->delete();

        return response()->json([
            'message' => true,
        ]);
    }
}
