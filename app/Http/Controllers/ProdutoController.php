<?php

namespace App\Http\Controllers;



use App\Produto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{

    public function __construct(Produto $produto){
        $this->prod = $produto;
    }

    /*
     * Retorna todos os produtos cadastrados
     */
    public function all(){
        return $this->prod->all();
    }

    /*
     * Cadastra um novo produto
     */
    public function add(Request $request){
        // Recebe os dados que vierem via POST em JSON
        $arrProduto = $request->json()->all();

        // Cria o produto no banco
        $resp = $this->prod->create($arrProduto);

        // Verifica da o retorno da requisicao
        if(!$resp){
            return response()->json(['errorMsg' => 'Ocorreu um erro no sistema, tente novamente'], 200);
        }

        return response()->json(['id' => $resp], 201);
    }

    /*
     * Valida um codigo de produto
     */
    public function validaCodigo($cod){
        // Chama o metodo que faz a busca
        $resp = $this->prod->validaCodigo($cod);

        // Verifica e da o retorno da requisicao
        if(!$resp){
            return response()->json(['errorMsg' => 'Codigo existente.'], 200);
        }

        return response()->json([], 201);
    }

    /*
     * Metodo que gera as estatisticas, porcentagens e calcula o "mix" de cada produto
     */
    public function estatistica(){
        // Chama o metodo que gera os dados
        $resp = $this->prod->gerarEstatistica();

        // Verifica e da o retorno da requisicao
        if(!$resp){
            return response()->json(['errorMsg' => 'Ocorreu um erro no sistema, tente novamente.'], 200);
        }

        return response()->json($resp, 201);
    }
}
