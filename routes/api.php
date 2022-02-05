<?php

use App\Http\Controllers\AutomobilController;
use App\Http\Controllers\KompanijaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            "message" => "Podaci nisu dobri"
        ]);
    }
    return $user->createToken($user->email)->plainTextToken;
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
    });

    Route::get('automobil', [AutomobilController::class, 'ucitavanje']);
    Route::post('automobil', [AutomobilController::class, 'dodavanje']);
    Route::put('automobil/{id}', [AutomobilController::class, 'izmena']);
    Route::delete('automobil/{id}', [AutomobilController::class, 'brisanje']);

    Route::get('kompanija', [KompanijaController::class, 'ucitavanje']);
    Route::get('kompanija/{id}/automobili', [KompanijaController::class, 'automobili_kompanije']);
});
