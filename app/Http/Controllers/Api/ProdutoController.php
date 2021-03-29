<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produto;

class ProdutoController extends Controller
{
    public function status () {
        return ['status' => 'ok'];
    }

    public function add(Request $request) {

        try {

            $produto = new Produto;
            $produto->titulo = $request->titulo;
            $produto->imagem = $request->imagem;
            $produto->preco = $request->preco;
            $produto->descricao = $request->descricao;
            $produto->url = $request->url;

            $produto->save();

            return ['retorno' => 'ok'];

        } catch (\Exception $erro) {
            return ['retorno' => 'ERRO', 'details' => $erro];
        }
    }

    public function list() {

        $produto = Produto::all('titulo', 'imagem', 'preco', 'descricao', 'url');

        return $produto;
    }

    public function listById($id) {

        $produto = Produto::find($id);

        if (empty($produto)) {
            return ['retorno' => 'Produto não existe'];
        }

        return $produto;
    }

    public function update(Request $request, $id) {

        try {

            $produto = Produto::find($id);

            $produto->titulo = $request->titulo;
            $produto->imagem = $request->imagem;
            $produto->preco = $request->preco;
            $produto->descricao = $request->descricao;
            $produto->url = $request->url;

            $produto->update();

            return ['retorno' => 'ok', 'data' => $request->all()];

        } catch (\Exception $erro) {
            return ['retorno' => 'ERRO', 'details' => $erro];
        }
    }

    public function delete($id) {

        try {

            $produto = Produto::find($id);
            $produto->delete();

            return ['retorno' => 'ok'];

        } catch (\Exception $erro) {
            return ['retorno' => 'ERRO', 'details' => $erro];
        }
    }
}
