<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    public $timestamps = false;
    protected $fillable = ['codigo', 'nome', 'quantidade'];

    /*
     * Método que valida o codigo de um produto
     */
    public function validaCodigo($codigo){
        // prepara e executa a query
        $sql = 'SELECT id FROM produtos WHERE codigo = :cod';
        $rows = DB::select($sql, [':cod' => $codigo]);

        if(count($rows) > 0){
            // retorna false caso o codigo seja invalido
            return false;
        }

        // retorna true para um codigo valido
        return true;
    }

    /*
     * Método que calcula o "mix" do produto, calcula a porcentagem e gera a estatistica final
     */
    public function gerarEstatistica($num){
        // Pega a quantidade total de produtos vendidos
        $sqlTotal = 'SELECT SUM(quantidade) AS TOTAL FROM produtos';
        $query = DB::select($sqlTotal);
        $total = $query[0]->TOTAL;

        // Pega as informacoes dos produtos, e calcula o valor do "mix" de cada produto
        $sql = 'SELECT id, codigo, nome, quantidade, (quantidade / :total) AS mix FROM produtos ORDER BY quantidade DESC;';
        $query = DB::select($sql, [':total' => $total]);

        // Calcula a porcentagem de venda de cada produto, e monta o array de retorno
        foreach ($query as $key => $v) {
            $resp[] = array(
                'id' => $v->id,
                'codigo' => $v->codigo,
                'nome' => $v->nome,
                'quantidade' => $v->quantidade,
                'porcentagem' => round((100 * $v->quantidade) / $total),
                'mix' => round($v->mix, 2),
                'estatistica' => round(($v->mix * $num), 2)
            );
        }

        return array('total' => $total, 'prod' =>$resp);
    }
}
