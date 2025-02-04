<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function index()
    {
        Config::set('title', 'Languages');

        $languages = Language::all();

        return view('admin.languages', compact('languages'));
    }

    public function createForm()
    {
        return view('admin.modals.language_create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:languages,code|size:2',
            'name' => 'required|min:3|max:10'
        ]);

        $values = [
            'code' => strtolower($request->code),
            'name' => $request->name,
            'is_active' => $request->is_active == 'on',
            'is_default' => $request->is_default == 'on'
        ];

        if ($language = Language::create($values)) {
            if ($request->is_default) {
                Language::isDefault()->whereKeyNot($language->id)->update([ 'is_default' => false ]);
            }

            return 'success';
        }

        return 'error';
    }

    public function updateForm($id)
    {
        $language = Language::findOrFail($id);

        return view('admin.modals.language_update', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);

        $validate = [ 'name' => 'required|min:3|max:10' ];

        if ($language->code <> $request->code) {
            $validate['code'] = 'required|unique:languages,code|size:2';
        }

        $request->validate($validate);

        $values = [
            'code' => strtolower($request->code),
            'name' => $request->name,
            'is_active' => $request->is_active == 'on',
            'is_default' => $request->is_default == 'on'
        ];

        if ($language->update($values)) {
            if ($request->is_default) {
                Language::isDefault()->whereKeyNot($id)->update([ 'is_default' => false ]);
            }

            return 'success';
        }

        return 'error';
    }

    public function delete($id)
    {
        $language = Language::findOrFail($id);

        if ($language->is_default) {
            return redirect(route('languages'))->withErrors([
                'The default language option cannot be deleted.'
            ]);
        }

        $language->delete();
    }

    public function active(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $is_active = $request->value == 'true';

        if ($language->is_default && !$is_active) {
            abort(403, 'Default recording cannot be disabled');
        }

        $language->update([ 'is_active' => $is_active ]);
    }

    public function default(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $is_default = $request->value == 'true';

        if (!$is_default) {
            abort(403, 'Recording already set to default');
        }

        $language->update([ 'is_default' => $is_default, 'is_active' => true ]);
        Language::isDefault()->whereKeyNot($id)->update([ 'is_default' => false ]);
    }
}
