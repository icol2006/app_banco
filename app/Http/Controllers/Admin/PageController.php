<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{
    public function list_users()
    {       
        $user = auth()->user();
        $roles = Role::all();

        // get all users with all roles
        $users = User::with('roles')->orderBy('id', 'desc')
            ->withTrashed()->get()->where('id', '!=', $user->id);

        $data = [
            'roles'  => $roles,
            'users'  => $users,
        ];

        return view("admin.list_users", compact('data'));
    }

    public function edit_user($id)
    {
        $user = User::withTrashed()->find($id);
        $roles = Role::all()->where('code', '<>', 2);

        $data = [
            'user'  => $user,
            'roles'  => $roles,
        ];

        return view('admin.edit_user', compact('data'));
    }

    public function create_user()
    {
        $roles = Role::all();

        $data = [
            'roles'  => $roles,
        ];

        return view('admin.create_user', compact('data'));
    }

    public function update_user(Request $request, $id)
    {
        $input = $request->all();
        $user = User::withTrashed()->find($id);

        $requestEmail = $input['email'];

        if ($requestEmail != $user->email) {
            $request->validate([
                'email' => 'required|email|unique:users'
            ]);
        }

        $user->update($input);

        return redirect('admin/list_users')->with('success', 'Datos guardados!');
    }

    public function store_user(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
            'email' => 'required|email|unique:users'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $user->assignRole($input['role']);

        return redirect('admin/list_users')->with('success', 'Datos guardados!');
    }

    public function disable_user(Request $request, $id)
    {

        $datos = User::find($id);
        $datos->delete();

        return redirect('admin/list_users')->with('success', 'Datos guardados!');
    }

    public function enable_user(Request $request, $id)
    {
        //$datos = User::find($id);
        $datos = User::withTrashed()->find($id);
        $datos->restore();

        return redirect('admin/list_users')->with('success', 'Datos guardados!');
    }

    public function delete_user($id)
    {
        try {
            $datos = User::withTrashed()->find($id);
            $datos->forceDelete();
        } catch (\Illuminate\Database\QueryException $e) {

            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                $errors = array();
                array_push($errors, 'No se puede borrar el registro. Esta siendo usado en la base de datos');

                return redirect()->route('admin.list_users')
                    ->with('errors', $errors);
            }
        }

        return redirect()->route('admin.list_users')
            ->with('success', 'Registro borrado exitosamente');
    }
}
