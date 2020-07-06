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

        $request->validate([

            'inputSenha'=> 'required|min:6',
            'inputConfirma'=> 'required|same:inputSenha|min:6',
        ]);

        $user = User::find($id);

        $user->nome = $request->inputNome;
        $user->sobrenome = $request->inputSobrenome;
        $user->cpf = $request->inputCPF;
        $user->rg = $request->inputRG;
        $user->endereco = $request->inputEndereco;
        $user->cep = $request->inputCep;
        $user->password = $request->inputSenha;
        $user->uf = $request->inputUF;
        $user->cidade = $request->inputCidade;

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $user->email = $request->inputEmail;
        }

        if(!empty($request->inputSenha)){
            $user->password = Hash::make($request->inputSenha);
        }
        $user->update();

        return view('editUsuarios')->with([
            'user'=> $user,
            'success'=>'Usuário alterado com sucesso'
        ]);
    }

    public function createPage(){
        return view('cadastro');
    }
    public function createUser(Request $request){

        $request->validate([

            'inputSenha'=> 'required|min:6',
            'inputConfirma'=> 'required|same:inputSenha|min:6',
        ]);

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
            return view('cadastro')->with('success', 'Usuário inserido com sucesso');
        }
    }

    public function deleteUser($id){
        $user = User::find($id);

        if($user->delete()){
            $users = User::paginate(10);

            return view('admUsuarios')->with([
                'users'=>$users,
                'success'=> 'Usuário excluído com sucesso'
            ]);
        }
    }
    public function searchUser(Request $request){
        $search = $request->input('search');
        $users = User::where('nome', 'like', '%'.$search.'%')->orWhere('sobrenome', 'like','%'.$search.'%')->paginate(10);

        return view('admUsuarios')->with([
            'search'=>$search,
            'users'=>$users
        ]);
    }

}
