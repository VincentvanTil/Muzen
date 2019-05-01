<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Auth;
use App\Address;

class AddAddressController extends Controller
{
    public function index(){
      return view('addaddress');
    }


    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'streetname'=>'required|min:2',
            'zipcode'=>'required|min:5',
            'place'=>'required|min:2',

        ]);

        $address = new Address();
    if(Auth::user()) {
      $address->user_id = Auth::user()->id;
    } else {
      $address->user_id = 1;
    }

        $address->streetname=$validatedData['streetname'];
        $address->zipcode=$validatedData['zipcode'];
        $address->place=$validatedData['place'];


        $address->save();
      }

}
