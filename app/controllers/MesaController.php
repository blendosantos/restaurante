<?php

/**
 * Description of MesaController
 *
 * @author Blendo Santos
 */
class MesaController extends BaseController {

    public function getIndex() {
        $mesa = Mesa::all();
        return View::make('lista-mesa', compact('mesa'));
    }

    public function getCadastro() {
        $id = Input::get('id');

        if (isset($id)) {
            $mesa = Mesa::find($id);
            return View::make('cadastro-mesa', compact('mesa'));
        }

        return View::make('cadastro-mesa');
    }

    public function postCadastro() {        
        $id = Input::get('id');
        $localMesa = Input::get('localMesa');
        $nuMesa = Input::get('nuMesa');
        $qtdPessoas = Input::get('qtdPessoas');
        
        if (isset($id)) {
            $mesa = Mesa::find($id);
            $mesa->localMesa = $localMesa;
            $mesa->nuMesa = $nuMesa;
            $mesa->qtdPessoas = $qtdPessoas;
            $mesa->save();
        } else {
            $mesa = new Mesa();
            $mesa->localMesa = $localMesa;
            $mesa->nuMesa = $nuMesa;
            $mesa->qtdPessoas = $qtdPessoas;
            $mesa->status = 'AT';
            $mesa->save();
        }
        return Redirect::to('/mesa');
    }
    
    public function getAtivar() {
        $id = Input::get('id');
        $mesa = Mesa::find($id);
        $mesa->status = 'AT';
        $mesa->save();
        return Redirect::to('/mesa');
    }
    
    public function getInativar() {
        $id = Input::get('id');
        $mesa = Mesa::find($id);
        $mesa->status = 'IN';
        $mesa->save();
        return Redirect::to('/mesa');
    }

    public static function getDelete() {
        $id = Input::get('id');
        $mesa = Mesa::find($id);
        $mesa->delete();
        return Redirect::to('/mesa');
    }

    public static function getMesaToId($id) {
        $mesa = Mesa::find($id);
        $mesaToId = "Nº ".$mesa->nuMesa . ", ".$mesa->localMesa;
        return $mesaToId;
    }
    
    public static function getMesaActive() {
        return Mesa::where('status', 'AT')->get();
    }
}
