<?php

use App\Http\Controllers\AulaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('aulas', [AulaController::class, "index"])->name("aula.index");
Route::post('aulas', [AulaController::class, "store"])->name("aula.store")->middleware(['auth:sanctum']);
Route::get('aulas/create', [AulaController::class, "create"])->name("aula.create")->middleware(['auth:sanctum']);
Route::get('aulas/{id}', [AulaController::class, "show"])->name("aula.show");
Route::delete('aulas/{id}', [AulaController::class, "destroy"])->name("aula.destroy")->middleware(['auth:sanctum']);;
Route::put('aulas/{id}', [AulaController::class, "update"])->name("aula.update")->middleware(['auth:sanctum']);

Route::post("/register", function (Request $request) {
    $request->validate([
        'email' => 'required|string|email|unique:users,email',
        'name' => 'required|string',
        'password' => 'required|min:8|max:20'
    ]);

    $user = User::create([
        'email' => $request->email,
        'name' => $request->name,
        'password' => Hash::make($request->password)
    ]);

    return response()->json([
        "message" => "Sucesso",
        "user" => $user
    ]);
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if(Auth::attempt($credentials)){
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    return response()->json(['message' => "Úsuario Inválido!"]);
});
