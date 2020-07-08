<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function listMessage(){

        if(Auth::check()===true){
            $messages = Message::paginate(10);
    
            return view('admin.admMensagens')->with('messages',$messages);
            
        }
        return redirect()->route('admin.login');
    }

    public function pagContato(){
        return view('contato');
    }
    public function sendMessage(Request $request){

        $request->validate([
            'inputAssunto' => 'required|min:5',
            'inputMensagem'=> 'required|min:10'
        ]);

        $message = new Message;

        $message->nome = $request->inputNome;
        $message->sobrenome = $request->inputSobrenome;
        $message->email = $request->inputEmail;
        $message->assunto = $request->inputAssunto;
        $message->conteudo = $request->inputMensagem;

        $message->save();

        if($message){
            return view('contato')->with('success', 'Mensagem enviada com sucesso');
        }
    }

    public function deleteMessage($id){
        $message = Message::find($id);

        if($message->delete()){
            $messages = Message::paginate(10);

            return view('admin.admMensagens')->with([
                'messages'=> $messages,
                'success'=> 'Usuário excluído com sucesso'
            ]);
        }
    }
    public function searchMessage(Request $request){
        $search = $request->input('search');
        $messages = Message::where('assunto', 'like', '%'.$search.'%')->orWhere('nome', 'like','%'.$search.'%')->paginate(10);

        return view('/admin/admMensagens')->with([
            'search'=>$search,
            'messages'=>$messages
        ]);

    }

    
}
