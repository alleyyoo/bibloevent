<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class SettingController extends Controller
{
    public function updateForm()
    {
        return view('admin.modals.settings');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'email' => 'email|nullable'
        ]);

        $locales = [ 'title', 'description', 'keywords' ];

        foreach ($request->all() as $name => $value) {
            if ($name == '_token') continue;
            $attributes = [ 'name' => $name, 'locale' => in_array($name, $locales) ? App::getLocale() : null ];
            Setting::updateOrCreate($attributes, $attributes + [ 'value' => $value ]);
        }

        return 'success';
    }
}
