<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Fragment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class FragmentController extends Controller
{
    //
    public function index(Request $request)
    {
        Config::set('title', 'Dil Sabitleri');

        $fragments = Fragment::all();

        $languages = \config('languages');

        return view('admin.fragments', compact('fragments', 'languages'));
    }

    public function update(Request $request)
    {

        $fragment = Fragment::find($request->id);

        $languages = \config('languages');

        /*validation*/
        $validate = [];

        foreach ($languages as $key => $value) {

            $validate[$key] = ['required', 'string'];
        }

        $validate['key'] = ['required', 'string'];

        $request->validate($validate);

        /**/
        $updateFragment = [];

        foreach ($languages as $key => $value) {

            $updateFragment[$key]['value'] = $request->$key;
        }

        $updateFragment['key'] = $request->key;

        if ($fragment) {

            $fragment->update($updateFragment);

        }

        return redirect()->route('admin.fragments');
    }

    public function createForm()
    {
        $languages = \config('languages');

        return view('admin.modals.fragment_create', compact('languages'));
    }

    public function create(Request $request)
    {

        $languages = \config('languages');

        $validate = [];

        foreach ($languages as $key => $value) {

            $validate[$key] = ['required', 'string'];
        }

        $validate['key'] = ['required', 'string'];

        $request->validate($validate);



        $createFragment = [];

        foreach ($languages as $key => $value) {

            $createFragment[$key]['value'] = $request->$key;
        }

        $createFragment['key'] = $request->key;

        $fragment = Fragment::create($createFragment);


        if ($fragment){
            return 'success';
        }else{
            return 'error';

        }

        return redirect()->route('admin.fragments');

    }

    public function delete(Request $request)
    {


        $fragment = Fragment::find($request->id);

        if ($fragment) {

            $fragment->delete();
        }

        return redirect()->route('admin.fragments');


    }
}
