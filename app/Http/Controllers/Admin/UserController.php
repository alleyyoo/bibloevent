<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        Config::set('title', 'Users');

        $users = User::all();

        return view('admin.users', compact('users'));
    }

    public function createForm()
    {
        return view('admin.modals.user_create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => [ 'required', 'string', 'max:255' ],
            'email' => [ 'required', 'string', 'email', 'max:255', 'unique:users' ],
            'password' => [ 'required', 'string', 'min:8', 'confirmed' ]
        ]);

        $response = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $response ? 'success' : 'error';
    }

    public function updateForm($id)
    {
        $user = User::findOrFail($id);

        return view('admin.modals.user_update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate = [ 'name' => [ 'required', 'string', 'max:255' ] ];
        $values = [ 'name' => $request->name ];

        if ($request->email <> $user->email) {
            $validate['email'] = [ 'required', 'string', 'email', 'max:255', 'unique:users' ];
            $values['email'] = $request->email;
        }

        if ($request->password) {
            $validate['password'] = [ 'required', 'string', 'min:8', 'confirmed' ];
            $values['password'] = Hash::make($request->password);
        }

        $request->validate($validate);
        $response = $user->update($values);

        return $response ? 'success' : 'error';
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }

    public function active(Request $request, $id)
    {
        User::findOrFail($id)->update([ 'is_active' => $request->value == 'true' ]);
    }

    public function passwordForm()
    {
        return view('admin.modals.password');
    }

    public function password(Request $request)
    {
        $request->validate([ 'password' => [ 'required', 'string', 'min:8', 'confirmed' ] ]);

        $response = Auth::user()->update([ 'password' => Hash::make($request->password) ]);

        return $response ? 'success' : 'error';
    }
}
