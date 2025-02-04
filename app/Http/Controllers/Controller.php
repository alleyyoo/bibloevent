<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Page;
use App\Models\Translations\PageTranslation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function locale($locale)
    {
        if (!Language::where('code', $locale)->isActive()->exists()) {
            abort(404);
        }

        Session::put('locale', $locale);

        $slug = trim(preg_replace(['|^'.url('/').'|', '|\?.*|'], '', url()->previous()), '/');
        if (strpos($slug, 'pannel') !== false) {
;            return redirect()->back();
        } else {
            $slug = substr($slug, 3, strlen($slug));
            return redirect($locale);
        }



    }
}
