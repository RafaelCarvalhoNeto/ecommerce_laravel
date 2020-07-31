<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    // LISTAR USUÁRIOS
    public function listAllUsers(){

        if(Auth::check()===true){
            if(Auth::user()->admin==1){
                $users = DB::table('users');
                $found = $users->count();
                $users = $users->paginate(10);

                $estados = array( "AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO" );
        
                return view('admin.admUsuarios')->with(['users'=>$users, 'found'=>$found, 'estados'=>$estados]);


            }

        }
        return redirect()->route('admin.login');
    }
    // GERAR A PÁGINA DE EDITAR USUÁRIOS - DIRETORIO USUÁRIOS
    public function editUser($id){
        $user = User::find($id);

        $estados = array( "AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO" );


        if($user){
            return view('usuarios.editUsuarios')->with(['user'=>$user, 'estados'=>$estados]);
        }
    }
    // EDITAR USUÁRIOS
    public function updateUser(Request $request, $id){

        $user = User::find($id);

        $user->nome = $request->inputNome;
        $user->sobrenome = $request->inputSobrenome;
        $user->cpf = $request->inputCPF;
        $user->rg = $request->inputRG;
        $user->endereco = $request->inputEndereco;
        $user->cep = $request->inputCep;
        $user->uf = $request->inputUF;
        $user->cidade = $request->inputCidade;

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $user->email = $request->inputEmail;
        }

        if(!empty($request->inputSenha)){
            $request->validate([

                'inputSenha'=> 'min:6',
                'inputConfirma'=> 'same:inputSenha|min:6',
            ]);

            $user->password = Hash::make($request->inputSenha);
        }
        $user->update();

        if(Auth::user()->admin!=1){
            return view('usuarios.editUsuarios')->with([
                'user'=> $user,
                'success'=>'Usuário alterado com sucesso'
            ]);

        } 
        return redirect()->route('users.listAll')->with('success', 'Usuário alterado com sucesso');

    }

    // GERAR PÁGINA DE CADASTRO DE USUÁRIOS
    public function createPage(){
        return view('cadastro');
    }
    public function createUser(Request $request){

        $request->validate([

            'inputSenha'=> 'required|min:6',
            'inputConfirma'=> 'required|same:inputSenha|min:6',
        ]);

        $password = $request->inputSenha;

        $user = new User;

        $user->nome = $request->inputNome;
        $user->sobrenome = $request->inputSobrenome;
        $user->cpf = $request->inputCPF;
        $user->rg = $request->inputRG;
        $user->endereco = $request->inputEndereco;
        $user->cep = $request->inputCep;
        $user->password = $request->inputSenha;
        $user->uf = $request->inputUF;
        $user->cidade = $request->inputCidade;
        $user->email = $request->inputEmail;
        $user->password = Hash::make($request->inputSenha);

        $user->save();

        if($user){
            $credentials = [
                'email'=> $user->email,
                'password'=> $password
            ];

            if (Auth::attempt($credentials)){
                return redirect()->route('home');
            }
            return view('cadastro');
        }
    }

    // DELETAR USUÁRIOS
    public function deleteUser($id){
        $user = User::find($id);

        if($user->delete()){
               
            return redirect()->route('users.listAll')->with('success', 'Usuário excluído com sucesso');

        }
    }

    // PROCURAR USUÁRIOS
    public function searchUser(Request $request){
        $search = $request->input('search');
        $users = User::where('nome', 'like', '%'.$search.'%')->orWhere('sobrenome', 'like','%'.$search.'%');
        $found = $users->count();
        $users = $users->paginate(10);

        $estados = array( "AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO" );

        return view('admin.admUsuarios')->with([
            'search'=>$search,
            'users'=>$users,
            'found'=>$found,
            'estados'=>$estados
        ]);
    }

}
