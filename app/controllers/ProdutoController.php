<?php

/**
 * Description of ProdutoController
 *
 * @author Blendo Santos
 */
class ProdutoController extends BaseController {

    public function getIndex() {
        $produto = Produto::all();
        return View::make('lista-produto', compact('produto'));
    }

    public function postIndex() {
        $dsProduto = Input::get('descricao');
        $produto = Produto::where('dsProduto', 'like', '%' . $dsProduto . '%')->get();
        return View::make('lista-produto', compact('produto'));
    }

    public function getCadastro() {
        $id = Input::get('id');

        if (isset($id)) {
            $produto = Produto::find($id);
            return View::make('cadastro-produto', compact('produto'));
        }

        return View::make('cadastro-produto');
    }

    public function postCadastro() {
        $id = Input::get('id');
        $vlProduto = str_replace(array("R$", "."), "", Input::get('vlProduto'));
        $vlProduto = str_replace(",", ".", $vlProduto);
        $qtdProduto = str_replace(" ", "", Input::get('qtdProduto'));
        $dsProduto = Input::get('dsProduto');

        if (isset($id)) {
            $produto = Produto::find($id);
            $produto->dsProduto = $dsProduto;
            $produto->vlProduto = $vlProduto;
            $produto->qtdProduto = $qtdProduto;
            $produto->save();
            return Redirect::to('/produto');
        }

        $produto = new Produto();
        $produto->dsProduto = $dsProduto;
        $produto->vlProduto = $vlProduto;
        $produto->qtdProduto = $qtdProduto;
        $produto->status = 'AT';
        $produto->save();

        return Redirect::to('/produto');
    }

    public static function getDelete() {
        $id = Input::get('id');
        $produto = Produto::find($id);
        $produto->delete();
        return Redirect::to('/produto');
    }
    
    public static function getProdutosActive() {
        return Produto::where('status', 'AT')->lists('dsProduto', 'id');
    }

}
