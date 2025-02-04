<?php

namespace App\Providers;

use App\Models\Certificate;
use App\Models\Country;
use App\Models\Language;
use App\Models\Page;
use App\Models\ProductTable;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('pushonce', function ($expression) {
            $domain = explode(':', trim(substr($expression, 1, -1)));
            $push_name = $domain[0];
            $push_sub = $domain[1];
            $isDisplayed = '__pushonce_' . $push_name . '_' . $push_sub;
            return "<?php if(!isset(\$__env->{$isDisplayed})): \$__env->{$isDisplayed} = true; \$__env->startPush('{$push_name}'); ?>";
        });

        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });

        Schema::defaultStringLength(191);

        Config::set('sluggable_views', ['index', 'show', 'menu', 'slider', 'projects', 'project', 'teams']);
        Config::set('content', [
            'show' => ['media', 'gallery','desc','show_menu', 'is_sub'],
            'menu' => ['show_menu'],
            'sliders' => ['desc'],
            'slider' => ['media', 'video', 'desc'],
            'projects' => ['show_menu', 'desc', 'alt_header', 'content'],
            'project' => ['media', 'gallery', 'cover', 'desc', 'year'],
            'about' => ['show_menu', 'desc', 'media', 'gallery'],
            'reference' => ['media'],
            'teams' => ['show_menu', 'desc'],
            'team' => ['title', 'job', 'media']
        ]);

        if (Schema::hasTable('languages')) {

            $languages = Language::isActive()->get();
            Config::set('translatable.locales', $languages->pluck('code')->toArray());
            foreach ($languages as $language) {
                Config::set('languages.' . $language->code, $language->name);
            }

            if (Cookie::has('locale')) {
                $code = Crypt::decryptString(Cookie::get('locale'));
                if (Language::where('code', $code)->exists()) {
                    App::setLocale($code);
                }
            } elseif ($default = Language::isDefault()->first()) {
                App::setLocale($default->code);
            }

        }

        if (Schema::hasTable('settings')) {
            foreach (Setting::where('locale', App::getLocale())->orWhereNull('locale')->get() as $setting) {
                Config::set("setting.$setting->name", $setting->value);
            }
        }

        if (Schema::hasTable('pages')) {
            view()->share('menu', Page::whereNull('category_id')->isActive()->isVisible()->isMenu()->orderBy('sort_id', 'asc')->get());
        }
    }
}
