<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileUserController extends Controller
{
    public function index() 
    {
        return view('admin_user.profile_user.index');
    }

    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'user_img' => ['image', 'max:2048']
        ]);        

        $user = Auth::user();

        if($request->hasFile('user_img')){
            if(File::exists(public_path($user->user_img))){
                File::delete(public_path($user->user_img));
            }
            $image = $request->file('user_img');
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/selected'), $imageName);

            $path = "uploads/".$imageName;

            $user->user_img = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile updated properly!');
        return redirect()->back();
    }

    /** Update Password */
    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password updated properly!');
        return redirect()->back();
    }
}
