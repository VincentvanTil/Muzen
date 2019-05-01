<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
  public function index(){
  return view('changepassword');
  }

  public function changePassword(Request $request){
    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
      //wachtwoord komt niet overeen
      return redirect()->back()->with("error", "Your current password does not match");
    }

    if(strcmp($request->get('currennt-password'), $request->get('new-password')) == 0){

      return redirect()->back()->with("error");
    }
    $validatedData = $request->validate([
      'current-password' => 'required',
      'new-password' => 'required|string|min:6|confirmed',
    ]);

    $user = Auth::user();
    $user->password = bcrypt($request->get('new-password'));
    $user->save();

    return redirect()->back()->with("successss");
  }
}
