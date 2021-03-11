<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\helper\ViewTemplateInterface\itemTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Jobs\ProcessItem;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bindMethod([ProcessItem::class, 'handle'], function ($job, $app) {
            return $job->handle();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                if ($user_id != null) {
                    $user = User::find($user_id);
                    $notifications = $user->unreadNotifications->slice(0,1);
                    $view->with('notifications', $notifications);
                }
            }else
            $view->with('notifications', null);
        });
    }
}
