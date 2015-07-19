<?php

/**
 * Description of ReservaController
 *
 * @author Blendo Santos
 */
class ReservaController extends BaseController {

    public function getIndex() {
        $reserva = Reserva::all();
        return View::make('lista-reserva', compact('reserva'));
    }

    public function postIndex() {
        $dsServico = Input::get('descricao');
        $servicos = Input::get('servico');
        if (!empty($dsServico)) {
            $servico = Servico::where('dsServico', 'like', '%' . $dsServico . '%')->get();
        } else {
            $servico = Servico::where('servico', 'like', '%' . $servicos . '%')->get();
        }
        return View::make('lista-servico', compact('servico'));
    }

    public function getCadastro() {
        $id = Input::get('id');

        if (isset($id)) {
            $reserva = Reserva::find($id);
            return View::make('cadastro-reserva', compact('reserva'));
        }

        return View::make('cadastro-reserva');
    }

    public function postCadastro() {        
        $id = Input::get('id');
        $dsServico = Input::get('dsServico');
        $destaque = Input::get('destaque');
        $servicos = Input::get('servico');
        $vlServico = str_replace(array("R$", "."), "", Input::get('vlServico'));
        $vlServico = str_replace(",", ".", $vlServico);
        
        if (isset($id)) {
            $servico = Servico::find($id);
            $servico->dsServico = $dsServico;
            $servico->vlServico = $vlServico;
            $servico->servico = $servicos;
            $servico->destaque = $destaque;
            if (Input::hasFile('img')) {
                $img = Input::file('img');
                $img->move('upload/', $img->getClientOriginalName());
                $servico->img = 'upload/' . $img->getClientOriginalName();
            }
            $servico->save();
        } else {
            $servico = new Servico();
            $servico->dsServico = $dsServico;
            $servico->vlServico = $vlServico;
            $servico->servico = $servicos;
            $servico->destaque = $destaque;
            $servico->status = 'AT';
            if (Input::hasFile('img')) {
                $img = Input::file('img');
                $img->move('upload/', $img->getClientOriginalName());
                $servico->img = 'upload/' . $img->getClientOriginalName();
            }
            $servico->save();
        }
        return Redirect::to('/servico');
    }
    
    public function getAprovar(){
        $reserva = Reserva::find(Input::get('id'));
        $reserva->status = 'AP';
        $reserva->save();
        return Redirect::to('reserva');
    }
    
    public function getCancelar(){
        $reserva = Reserva::find(Input::get('id'));
        $reserva->status = 'RC';
        $reserva->save();
        return Redirect::to('reserva');
    }
}
