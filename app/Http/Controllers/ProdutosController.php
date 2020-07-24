<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    public function index() {

        // $produtos = Produto::paginate(10);
        $produtos = DB::table('produtos')
        ->leftjoin('categorias', 'produtos.categoria','=', 'categorias.id')
        ->select('produtos.nome', 'produtos.imagem', 'produtos.preco', 'produtos.id','categorias.tipo',
         'produtos.descricao', 'produtos.parcelamento')
        ->paginate(10);
        $categorias = Categoria::all();

        if($produtos){
            return view('admin.admProdutos')->with(['produtos'=> $produtos,'categorias'=>$categorias]);
        }
    
    
    }
    public function create(Request $request) {
         
        $imagem = $request->file('imagem');
        
        if(empty($imagem)){
            $pathRelative = null;
        } else{
            $imagem->storePublicly('uploads');
            
            $absolutePath = public_path()."/storage/uploads";

            $name = $imagem->getClientOriginalName();

            $imagem->move($absolutePath, $name);

            $pathRelative = "storage/uploads/$name";
        }

        $produto = new Produto;

        $produto->nome = $request->inputProduto;
        $produto->imagem = $pathRelative;
        $produto->categoria = $request->inputCategoria;
        $produto->preco  = $request->inputPreco;
        $produto->descricao = $request->inputDescricao;
        $produto->parcelamento = $request->inputParcelamento;

        $informacoes  = [
            $request->titulo1 => $request->inputTecnica1,
            $request->titulo2 => $request->inputTecnica2,
            $request->titulo3 => $request->inputTecnica3,
            $request->titulo4 => $request->inputTecnica4
        ];

        $arrayinfos = json_encode($informacoes);

        $produto->informacoes = $arrayinfos;
        

        $produto->save();

        if($produto){
            return redirect()->route('adm.produtos')->with('success','Usuário alterado com sucesso');
        }
    } 

    public function update(Request $request, $id){
        $produto = Produto::find($id);
        $imagem = $request->file('imagem');
        
        if(empty($imagem)){
            $pathRelative = null;
        } else{
            $imagem->storePublicly('uploads');
            
            $absolutePath = public_path()."/storage/uploads";

            $name = $imagem->getClientOriginalName();

            $imagem->move($absolutePath, $name);

            $pathRelative = "storage/uploads/$name";
        }

        $produto->nome = $request->inputProduto;
        $produto->imagem = $pathRelative;
        $produto->categoria = $request->inputCategoria;
        $produto->preco  = $request->inputPreco;
        $produto->descricao = $request->inputDescricao;
        $produto->parcelamento = $request->inputParcelamento;

        $informacoes  = [
            $request->titulo1 => $request->inputTecnica1,
            $request->titulo2 => $request->inputTecnica2,
            $request->titulo3 => $request->inputTecnica3,
            $request->titulo4 => $request->inputTecnica4
        ];

        $arrayinfos = json_encode($informacoes);

        $produto->informacoes = $arrayinfos;
        
        $produto->update();
        
        if($produto){
        $produtos = DB::table('produtos')
        ->leftjoin('categorias', 'produtos.categoria','=', 'categorias.id')
        ->select('produtos.nome', 'produtos.imagem', 'produtos.preco', 'produtos.id','categorias.tipo', 'produtos.descricao', 'produtos.parcelamento')
        ->paginate(10);
        $categorias = Categoria::all();

            return view('admin.admProdutos')->with(['produtos'=> $produtos,'categorias'=>$categorias,
                'success'=> 'Produto alterado com sucesso' ]);
        }
    }
    public function delete($id){
        
        $produto = Produto::find($id);

        if($produto->delete()){

            $produtos = Produto::paginate(10);
            $categorias = Categoria::all();

            if($produtos){
            return view('admin.admProdutos')->with([
                'produtos' => $produtos, 
                'categorias'=> $categorias,
                'success' => 'Registro excluído com sucesso'
                ]);
            }
        }
    }
    public function search(Request $request){

        $search = $request->input('inputSearch');

        $produtos = DB::table('produtos')
        ->leftjoin('categorias', 'produtos.categoria','=', 'categorias.id')
        ->select('produtos.nome', 'produtos.imagem', 'produtos.preco', 'produtos.id','categorias.tipo', 'produtos.parcelamento', 'produtos.descricao')
        ->where('produtos.nome', 'like' , '%'. $search . '%')
        ->orWhere('categorias.tipo', 'like' , '%'. $search . '%')
        ->paginate(10);
        // $produtos = Produto::where('nome', 'like', '%' . $search . '%')->paginate(10);
        $categorias = Categoria::All();

        return view('admin.admProdutos')->with([
            'search' => $search,
            'produtos' => $produtos,
            'categorias'=>$categorias
        ]);
    }
}
