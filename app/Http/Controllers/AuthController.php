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
        
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            //return redirect()->back()->withInput()->withErrors(['email'=>'O e-mail informado não é válido']);
            $login['success'] = false;
            $login['message'] = 'O e-mail informado não é válido';
            echo json_encode($login);
            return;            
        }
        
        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if (Auth::attempt($credentials)){
            //return redirect()->route('admin');
            $login['success'] = true;
            //$login['message'] = 'O e-mail informado não é válido';
            echo json_encode($login);
            return;
        }

        //return redirect()->back()->withInput()->withErrors(['email'=>'As informações não foram encontradas no sistema.']);
        $login['success'] = false;
        $login['message'] = 'As informações não foram encontradas no sistema.';
        echo json_encode($login);

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
