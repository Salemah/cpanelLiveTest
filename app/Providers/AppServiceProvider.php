<?php

namespace App\Providers;

use App\Models\CompanySetting;
use App\Models\LawCategory;
use App\Models\LegalArea;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {

            //$Setting = AccountSetting::first();
            $Setting = CompanySetting::first();

            $LegalAreas = LegalArea::where('status', 'Active')->take(5)->get();
            $LawCategorys = LawCategory::where('status', 'Active')->get();

            $view->with('dashboard_settings', $Setting);
            $view->with('comsultationArea', $LegalAreas);
            $view->with('LawCategorys', $LawCategorys);


            // return  $ActiveAddons;
        });

        Blade::directive('sanitizeHtml', function ($expression) {
            return "<?php echo $expression; ?>";
        });


        Schema::defaultStringLength(191);
    }
}
