<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class EditEmailController extends Controller
{
    public function index(){



      return view ('editmail');
    }


    public function editEmail(Request $request)
    {
      $validatedData = $request->validate([
        'email' => 'required|email|min:2',
      ]);


      $user = User::find(Auth::user()->id);
      $user->email = $request->email;
      $user->save();

      return redirect (url('/account'));

    }
}
