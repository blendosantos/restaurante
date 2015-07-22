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
        $idUserSolicitante = Input::get('idUserSolicitante');
        $status = Input::get('status');

        if (!empty($idUserSolicitante)) {
            $reserva = Reserva::where('idUserSolicitante', $idUserSolicitante)->get();
        } else {
            $reserva = Reserva::where('status', $status)->get();
        }
        return View::make('lista-reserva', compact('reserva'));
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
        $idUserSolicitante = Input::get('idUserSolicitante');
        $idMesa = Input::get('idMesa');
        $dtReserva = Input::get('dtReserva');
        $obsReserva = Input::get('obsReserva');

        if (isset($id)) {
            $reserva = Reserva::find($id);
            $reserva->idUserSolicitante = $idUserSolicitante;
            $reserva->idMesa = $idMesa;
            $reserva->dtReserva = $dtReserva;
            $reserva->obsReserva = $obsReserva;

            $reserva->save();
        } else {
            $reserva = new Reserva();
            $reserva->idUserSolicitante = $idUserSolicitante;
            $reserva->idMesa = $idMesa;
            $reserva->dtReserva = $dtReserva;
            $reserva->obsReserva = $obsReserva;
            $reserva->status = 'AP';

            $reserva->save();
        }
        return Redirect::to('/reserva');
    }

    public function getAprovar() {
        $reserva = Reserva::find(Input::get('id'));
        $reserva->status = 'AP';
        $reserva->save();
        return Redirect::to('reserva');
    }

    public function getCancelar() {
        $reserva = Reserva::find(Input::get('id'));
        $reserva->status = 'RC';
        $reserva->save();
        return Redirect::to('reserva');
    }

    public function getLancamento() {
        $id = Input::get('id');

        $reserva = Reserva::find($id);

        $produto = DB::table('reserva_produto as rp')
                ->join('produto as p', 'rp.idProduto', '=', 'p.id')
                ->where('idReserva', $id)
                ->select('rp.id', 'p.dsProduto', 'p.vlProduto')
                ->get();

        $servico = DB::table('reserva_servico as rs')
                ->join('servico as s', 'rs.idServico', '=', 's.id')
                ->where('idReserva', $id)
                ->select('rs.id', 's.servico', 's.dsServico', 's.vlServico')
                ->get();

        return View::make('lancamento-reserva', compact('reserva', 'produto', 'servico'));
    }

    public function getCadproduto() {
        $idReserva = Input::get('idReserva');
        $idProduto = Input::get('idProduto');
        
        DB::table('reserva_produto')->insert(
                array('idProduto' => $idProduto, 'idReserva' => $idReserva)
        );
        return Redirect::to('reserva/lancamento?id='.$idReserva);
    }
    
    public function getCadservico() {
        $idReserva = Input::get('idReserva');
        $idServico = Input::get('idServico');
        
        DB::table('reserva_servico')->insert(
                array('idServico' => $idServico, 'idReserva' => $idReserva)
        );
        return Redirect::to('reserva/lancamento?id='.$idReserva);
    }
    
    public function getDeletservico() {
        $idReserva = Input::get('idReserva');
        $idServico = Input::get('idServico');
        
        DB::table('reserva_servico')->where('id', $idServico)->delete();
        
        return Redirect::to('reserva/lancamento?id='.$idReserva);
    }
    
    public function getDeletproduto() {
        $idReserva = Input::get('idReserva');
        $idProduto = Input::get('idProduto');
        
        DB::table('reserva_produto')->where('id', $idProduto)->delete();
        
        return Redirect::to('reserva/lancamento?id='.$idReserva);
    }

}
