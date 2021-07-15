<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //Prifile View Load

    public function index(){
        // $id = Auth::user()->id;
        $admindata = Admin::find(1);
        return view('admin.admin_profile' , compact('admindata'));
    }

     //Prifile Edit View Load

     public function edit(){
        // $id = Auth::user()->id;
        $admindata = Admin::find(1);
        return view('admin.admin_profile_edit' , compact('admindata'));
    }

     //Prifile Data Update

     public function update(Request $request){
        $admin_update = Admin::find(1);
        $admin_update -> name = $request -> name;
        $admin_update -> email = $request -> email;
        if($request -> hasFile('profile_photo_path')){
            $file = $request -> profile_photo_path;
            @unlink(public_path('uploads/admin/' . $admin_update -> profile_photo_path));
            $photo = md5(time().rand()). '.'. $file -> getClientOriginalExtension();
            $file -> move(public_path('uploads/admin/') , $photo);
            $admin_update -> profile_photo_path = $photo;
        }

        $admin_update -> save();

        $msg = [
            'type' => 'success',
            'msg' => 'profile updated successfully',
        ];

        return redirect() ->route('admin.profile')->with($msg);

    }


    // Change Password View Load
    public function changepassword(){
        return view('admin.admin_change_password');
    }

     // Change Password Update
     public function passwordupdate(Request $request){
         $admin_update = Admin::find(1);

         $request -> validate([

            'old_password' => 'required',
            'password' => 'required|confirmed',

         ]);

         if(Hash::check($request -> old_password, $admin_update -> password)){
             $admin_update -> password = Hash::make($request -> password);
             $admin_update -> save();
             Auth::logout();
             return redirect() -> route('admin.logout');
         }else{
            return redirect() -> back();
         }



    }
}