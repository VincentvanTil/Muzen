<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class UserDescriptionController extends Controller
{

  public function index(){
    return view('editdescription');
  }


  public function store(Request $request)
  {
      $validatedData = $this->validate($request, [
          'description'=>'required|min:2'
      ]);

      $user = User::find(Auth::user()->id);
      $user->description = $request->description;
      $user->save();

      return redirect (url('/gallery'));

  }
}
