<?php

namespace App\Http\Controllers\ProfileUser;

use App\Http\Controllers\Controller;
use App\Models\ConstantsNames;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function data_profile()
    {
        $currentUser = User::find(Auth::user()->id);

        $data = [
            'user'  => $currentUser,
        ];

        return view("profile_user.data_profile", compact('data'));
    }

    public function update_data_profile(Request $request)
    {
        $currentUser = User::find(Auth::user()->id);
        $input = $request->all();

        $requestEmail = $input['email'];

        if ($requestEmail != $currentUser->email) {
            $request->validate([
                'email' => 'required|email|unique:users'
            ]);
        }


        $currentUser->name = $input['name'];
        $currentUser->lastname = $input['lastname'];
        $currentUser->email = $input['email'];
        $currentUser->phone = $input['phone'];
        $currentUser->save();

        $data = [
            'user'  => $currentUser,
        ];

        return redirect()->back()->with('success', 'Datos guardados!');

       // return view("profile_user.data_profile", compact('data'));
    }

    public function change_password(Request $request)
    {
        return view("profile_user.change_password");
    }


    public function update_password(Request $request)
    {
        $currentUser = User::find(Auth::user()->id);

        $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);

        $input = $request->all();
        $currentUser->password = bcrypt($input['password']);
        $currentUser->save();

        return redirect('profile_user/change_password')->with('success', 'Datos guardados!');
    }

    public function update_signature_image(Request $request)
    {
        $request->validate([
            'uploadFile' => 'required',
        ]);

        $filePath =  $request->uploadFile->store(ConstantsNames::$fileStorage);
        $file = pathinfo($filePath)['basename'];

        $input = $request->all();
        $input['document'] = $file;

        $currentUser = User::find(Auth::user()->id);
        $currentUser->signature_image = $file;
        $currentUser->save();

        return redirect('profile_user/data_profile')->with('success', 'Datos guardados!');
    }
}
