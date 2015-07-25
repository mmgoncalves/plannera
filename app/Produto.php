<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public $timestamps = false;
    protected $fillable = ['codigo', 'nome', 'quantidade'];

    /*
     * Método que valida o codigo de um produto
     */
    public function validaCodigo($codigo){
        // Verifica se o codigo ja esta cadastrado
        $rows = $this->where('codigo', $codigo)->get();

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
    public function gerarEstatistica(){
        // Pega a quantidade total de produtos vendidos
        $total = $this->sum('quantidade');

        // Recupera os produtos ordenados por quantidade
        $query = $this->select('id', 'codigo', 'nome', 'quantidade')->orderBy('quantidade', 'DESC')->get();

        // retorna a quantidade total de produtos vendidos, e uma lista com todos os produtos
        return array('total' => $total, 'prod' =>$query);
    }
}
