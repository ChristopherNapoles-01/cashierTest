<?php

namespace App\Providers;

use App\Models\AccountModel;
use Laravel\Cashier\Cashier;
use App\Models\SubscriptionsModel;
use App\Models\SubscriptionItemsModel;
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
        Cashier::useCustomerModel(AccountModel::class);
        Cashier::useSubscriptionModel(SubscriptionsModel::class);
        Cashier::useSubscriptionItemModel(SubscriptionItemsModel::class);
    }
}
