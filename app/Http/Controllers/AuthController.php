<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Auth\Events\Attempting;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function dashboard(){

        if(auth()->guard('admin')->check()===true){
            return redirect('/admin/home');
        }
        return redirect()->route('admin.login');
    }

    public function createPager(){
        return view('admin.cadastroAdms');
    }

    public function showHome(){
        return view ('admin.dashboard');
    }

    
    public function createUser(Request $request){

        $request->validate([

            'inputSenha'=> 'required|min:6',
            'inputConfirma'=> 'required|same:inputSenha|min:6',
        ]);

        $password = $request->inputSenha;

        $admin = new Admin;

        $admin->nome = $request->inputNome;
        $admin->sobrenome = $request->inputSobrenome;
        $admin->cpf = $request->inputCPF;
        $admin->email = $request->inputEmail;
        $admin->password = Hash::make($request->inputSenha);

        $admin->save();

        if($admin){
            $credentials = [
                'email'=> $admin->email,
                'password'=> $password
            ];

            if (auth()->guard('admin')->attempt($credentials)){
                return redirect('/admin/home');
            }
            return view('/admin/cadastroAdms');
        }
    }
    

    public function showLoginForm(){
        return view('admin.formLogin');
    }

    public function login(Request $request){

        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if (Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin.home');

        }

        // if ( auth()->guard('admin')->attempt($credentials)){
        //     return redirect()->route('admin');
        // }


        return redirect()->back()->withInput()->withErros(['Os dados informados não conferem!']);
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect('admin');
    }


}
