<?php

namespace App\Http\Controllers;



use App\Produto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    /*
     * Cadastra um novo produto
     */
    public function add(Request $request){
        // Recebe os dados que vierem via POST em JSON
        $arrProduto = $request->json()->all();

        // instancia o Model Produto, e chama o metodo que faz o insert na tabela
        $prod = new Produto();
        $resp = $prod->cadastrar($arrProduto);

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
        // Instancia o Model produto e chama o metodo que faz a busca
        $pro = new Produto();
        $resp = $pro->validaCodigo($cod);

        // Verifica e da o retorno da requisicao
        if(!$resp){
            return response()->json(['errorMsg' => 'Codigo existente.'], 200);
        }

        return response()->json([], 201);
    }

    /*
     * Metodo que gera as estatisticas, porcentagens e calcula o "mix" de cada produto
     */
    public function estatistica($num){
        // Instancia o Model produto e chama o metodo que gera os dados
        $prod = new Produto();
        $resp = $prod->gerarEstatistica($num);

        // Verifica e da o retorno da requisicao
        if(!$resp){
            return response()->json(['errorMsg' => 'Ocorreu um erro no sistema, tente novamente.'], 200);
        }

        return response()->json($resp, 201);
    }
}
