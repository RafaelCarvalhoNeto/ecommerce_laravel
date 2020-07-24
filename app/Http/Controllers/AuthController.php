<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function dashboard(){

        if(Auth::check()===true){
            if(Auth::user()->admin==1){

                return view('admin.dashboard');
            }
        }
        return redirect()->route('admin.login');
    }

    public function showLoginForm(){
        return view('admin.formLogin');
    }

    public function login(Request $request){
        
        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if (Auth::attempt($credentials)){
            return redirect()->route('admin');

        }
        return redirect()->back()->withInput()->withErrors(['email'=>'As informações não foram encontradas no sistema.']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin');
    }

    public function toggleAdmin(Request $request, $id){
        
        $user = User::find($id);
        $user->admin = $request->admin;
        $user->update();

        return redirect()->route('users.listAll');
    }


}
