<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('delete', function ($user){
            return $user->role === 'saller';
        });




        // View::composer('*', function ($view) {
        //     $sellerPendingCount = 0;
        
        //     if (Auth::check() && Auth::user()->role === 'saller') {
        //         $user = Auth::user();
        //         $store = $user->store;
        
        //         if ($store) {
        //             $storeId = $store->id;
        
        //             $sellerPendingCount = Order::where('status', 'pending')
        //                 ->whereHas('orderItems.products', function ($query) use ($storeId) {
        //                     $query->where('store_id', $storeId);
        //                 })
        //                 ->count();
        //         }
        //     }
        
        //     $view->with('sellerPendingCount', $sellerPendingCount);
        // });
    }
}
