<?php

use App\Models\Employee;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/test', function (Request $request) {
    //
    $employee = Employee::findByApiToken($request->bearerToken());
    //
    Log::info('api/test', [
        'employee->id' => $employee,
    ]);
    //
    return 'Authenticated!';
});

Route::middleware('auth:sanctum')->get('/sanctum_test', function (Request $request) {
    //
    // Hole den aktuellen Access Token
    $accessToken = $request->bearerToken();
    //
    $personalAccessTokenModel = Sanctum::personalAccessTokenModel();
    //
    $pat = $personalAccessTokenModel::findToken($accessToken);
    // Finde den Mitarbeiter, der mit diesem Access Token verbunden ist
    $employee = $pat->tokenable;
    //
    Log::info('api/sanctum_test', [
        'accessToken' => $accessToken,
        'personalAccessTokenModel' => $personalAccessTokenModel,
        'pat' => $pat,
        'employee' => $employee,
    ]);
    //
    return 'Authenticated!';
});
