<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function listAllUsers(){
        $users = User::paginate(10);

        return view('admUsuarios')->with('users', $users);
    }
    public function editUser($id){
        $user = User::find($id);

        if($user){
            return view('editUsuarios')->with('user',$user);
        }
    }

    public function updateUser(Request $request, $id){

        $user = User::find($id);

        $user->nome = $request->nome;
        $user->sobrenome = $request->sobrenome;
        $user->cpf = $request->cpf;
        $user->rg = $request->rg;
        $user->endereco = $request->endereco;
        $user->cep = $request->cep;
        $user->senha = $request->senha;
        $user->uf = $request->cidade;
        $user->cidade = $request->cidade;

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $user->email = $request->email;
        }

        if(!empty($request->senha)){
            $user->senha = Hash::make($request->senha);
        }
        $user->save();

        return view('editUsuarios')->with([
            'user'=> $user,
            'success'=>'Cartão alterado com sucesso'
        ]);
    }

    public function createPage(){
        return view('cadastro');
    }
    public function createUser(Request $request){

        $user = new User;

        $user->nome = $request->nome;
        $user->sobrenome = $request->sobrenome;
        $user->cpf = $request->cpf;
        $user->rg = $request->rg;
        $user->endereco = $request->endereco;
        $user->cep = $request->cep;
        $user->password = $request->password;
        $user->uf = $request->cidade;
        $user->cidade = $request->cidade;
        $user->email = $request->email;
        $user->senha = Hash::make($request->senha);

        $user->save();

        if($user){
            return view('cadastro')->with('success', 'Cartão inserido com sucesso');
        }
    }

    public function deleteUser($id){
        $user = User::find($id);

        if($user->delete()){
            $user = User::paginate(10);

            return view('admUsuarios')->with([
                'user'=>$user,
                'success'=> 'Registro excluído com sucesso'
            ]);
        }
    }

}
