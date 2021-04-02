<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produto;

use Goutte\Client;

use Symfony\Component\DomCrawler\Crawler;

use Carbon\Carbon;

class ProdutoController extends Controller
{
    public function add(Request $request) {

        try {

            //URL utilizada: https://www.amazon.com.br/Xiaomi-Vers%C3%A3o-Global-Lacrada-preta/dp/B07V822TVL

            $client = new Client();
            $produto = new Produto;

            if (!empty($request->url)) {

                $validate = Produto::where('url', '=', $request->url, 'and')->whereRaw("TIMESTAMPDIFF(MINUTE,created_at, NOW()) <= 60")->count();

                if ($validate == 1) {
                    $produto = Produto::all('titulo', 'imagem', 'preco', 'descricao', 'url');
                } else {
                    $crawler = $client->request('GET', $request->url);
                    $produto->titulo = $crawler->filter('h1 > span')->text();
                    $produto->descricao = $crawler->filter('#productDescription_feature_div')->text();
                    $produto->imagem = $crawler->filter('.a-button-text img')->eq(0)->attr('src');
                    $produto->preco = str_replace(",", ".", str_replace("R$", "", $crawler->filter('#priceblock_ourprice')->text()));
                    $produto->url = $request->url;

                    $produto->save();
                }

                return response()->json($produto);
            } else {
                return ['retorno' => 'ERRO', 'details' => "URL vazia!"];
            }



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

    public function listByUrl($url) {

        $produto = Produto::find($url);

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
