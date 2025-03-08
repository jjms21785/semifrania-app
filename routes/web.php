<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use App\Services\ProductService;
use App\Http\Controllers\ProductController;

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

//test-route
Route::get('/test-route/{post}/comment/{comment}', function (string $postID, string $comment) {
    return "Post ID: $postID, Comment: $comment";
});

Route::get('/post/{id}', function (string $id) {
    return $id;
})->where('id', '[0-9]+');

Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');

Route::get('/test/route', function () {
    return route ('test-route');
})->name('test-route');

Route::middleware(['user-middleware'])->group(function (){
    Route::get('/route-middleware-group/first', function (Request $request){
        echo "First";
    });
    Route::get('/route-middleware-group/second', function (Request $request){
        echo "Second";
    });
});

// Route - controller

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

//CSRF
/*
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    return view('token', ['token' => $token]);
});
*/

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    return view('token');
});

Route::post('/token', function (Request $request) {
    return $request->all();
});

Route::get('/users', [UserController::class, 'index'])->middleware('user-middleware');

Route::resource('product', ProductController::class);

Route::get('/product-list', function (ProductService $productService) {
    $data['products'] = $productService->listProducts();
    return view('products.list', $data);
});