<?php
 
 namespace App\Providers;
 
 use Illuminate\Support\ServiceProvider;
 use App\Services\ProductService;
 
 class ProductServiceProvider extends ServiceProvider
 {
     /**
      * Register services.
      */
     public function register(): void
     {
         $this->app->singleton(ProductService::class, function ($app) {
             $products = [
                 [
                     'id' => 1,
                     'name' => 'Apple',
                     'category' => 'fruits'
                 ],
                 [
                     'id' => 2,
                     'name' => 'orange',
                     'category' => 'fruits'
                 ],
                 [
                     'id' => 3,
                     'name' => 'mango',
                     'category' => 'fruits'
                 ]
             ];
             return new ProductService($products);
         });
     }
 
     /**
      * Bootstrap services.
      */
     public function boot(): void
     {
         //
         view()->share('productKey', 'hello');
     }
 }