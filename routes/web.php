<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (Request $request) {
    $input = $request->input('key');
    return $input;
});

Route::get('/test2',function (UserService $userService) {
    return $userService->listUsers();
});

Route::get('/test3', [UserController::class, 'index']);

Route::get('/test4',function (UserService $userService) {
    return Response::json($userService->listUsers());
});

