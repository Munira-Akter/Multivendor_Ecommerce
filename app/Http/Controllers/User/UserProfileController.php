<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //Profile Management View Load

    public function userprofileedit(){
        $id = Auth::user()->id;
        $userdata = User::find($id);
        $address = Address::where('user_id' , $id)->get();
        return view('user.user_profile_edit' , compact('userdata' , 'address'));
    }

    //Address Edit  View Load

    public function useraddressdelete($id){
        $address_id = Address::find($id);
        $address_id -> delete();
        return redirect() -> back();
    }

     //Address Default  View Load

     public function defaultaddress($id){
        $address_id = Address::find($id);
        $user_id = $address_id -> user_id;
        Address::where('id', '!=' , $id)
        ->where('user_id', '==' , $user_id)
        ->update(array('default_val' => 0));
        $address_id -> default_val = 1;
        $address_id -> save();

        $msg = [
            'type' => 'success',
            'msg' => 'Address added as Default',
        ];

        return redirect() -> back() -> with($msg);
    }



     //Profile Management Edit

     public function userprofileupdate(Request $request){
        $update_data = $request -> id;
        $updated_data = User::find($update_data);
        $photo = '';
        if($request -> hasFile('profile_photo_path')){
            $file = $request -> profile_photo_path;
            @unlink(public_path('uploads/user/' . $updated_data -> profile_photo_path));
            $photo = md5(time().rand()). '.'. $file -> getClientOriginalExtension();
            $file -> move(public_path('uploads/user/') , $photo);
            $updated_data -> profile_photo_path = $photo;

        }else{
            $photo = $request -> old_photo;
            $updated_data -> profile_photo_path = $photo;
        }


        $updated_data -> name = $request -> name;
        $updated_data -> phone = $request -> phone;
        $updated_data -> update();


        $msg = [
            'type' => 'success',
            'msg' => 'profile updated successfully',
        ];
        return redirect() -> route('dashboard') -> with($msg);

    }

    //Profile Management Edit

    public function userpasswordchange(Request $request){
        $update_data = $request -> id;
        $updated_data = User::find($update_data);
        $request -> validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if(Hash::check($request -> old_password, $updated_data -> password)){
            $updated_data -> password = Hash::make($request -> password);
            $updated_data -> save();
            Auth::logout();
            return redirect() -> route('login');
        }else{
           return redirect() -> back();
        }



    }

    // User delivery Address Add

    public function storeaddress(Request $request){
        $request -> validate([
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'add_phone' => 'required',
        ]);

        Address::create([

            'address' => $request -> address,
            'zip' => $request -> zip,
            'city' => $request -> city,
            'country' => $request -> country,
            'add_phone' => $request -> add_phone,
            'user_id' => $request -> id,

        ]);

        $msg = [
            'type' => 'success',
            'msg' => 'profile updated successfully',
        ];

        return redirect() -> back() -> with($msg);

    }

     // User delivery Address Add

     public function updateaddress(Request $request){
        $request -> validate([
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'add_phone' => 'required',
        ]);

        Address::create([

            'address' => $request -> address,
            'zip' => $request -> zip,
            'city' => $request -> city,
            'country' => $request -> country,
            'add_phone' => $request -> add_phone,
            'user_id' => $request -> id,

        ]);

        $msg = [
            'type' => 'success',
            'msg' => 'profile updated successfully',
        ];

        return redirect() -> back() -> with($msg);

    }

    // User Logout

    public function logout(){
        Auth::logout();
        return redirect() -> route('login');


    }



}