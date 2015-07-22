<?php

/**
 * Description of CaixaController
 *
 * @author Blendo.Santos
 */
class CaixaController extends BaseController {

    public function getIndex() {
        $totalCaixa = Caixa::find(DB::raw("(select max(id) as id from caixa)"));

        $reservas = DB::table('vlreservas')->get();

        return View::make('lancamento-caixa', compact('totalCaixa', 'reservas'));
    }
    
    public function getLancar() {
        $totalCaixa = Caixa::find(DB::raw("(select max(id) as id from caixa)"));
        $reservas = Reserva::where('status', '=', 'AP')->get();
        
        return View::make('lancamento-caixa', compact('totalCaixa', 'reservas'));
    }
    
    public static function getServicos($id){
        $servico = DB::table('reserva_servico as rs')
                ->join('servico as s', 'rs.idServico', '=', 's.id')
                ->where('idReserva', $id)
                ->select('rs.id', 's.servico', 's.dsServico', 's.vlServico')
                ->get();
        return $servico;
    }
    
    public static function getProdutos($id){
        $produto = DB::table('reserva_produto as rp')
                ->join('produto as p', 'rp.idProduto', '=', 'p.id')
                ->where('idReserva', $id)
                ->select('rp.id', 'p.dsProduto', 'p.vlProduto')
                ->get();
        return $produto;
    }
    
    public static function getFormaPagamento(){
        $getFormaPagamento = DB::table('forma_pagamento')->lists('dsForma', 'id');
        return $getFormaPagamento;
    }
    
    public static function getValorProdutos($id){
        $produto = DB::select('call vlProduto(?)',array($id));
        return $produto;
    }
    
    public static function getValorServicos($id){
        $servico = DB::select('call vlServico(?)',array($id));
        return $servico;
    }
    
    public function getReserva(){
        $idReserva = Input::get('id');
        $totalCaixa = Caixa::find(DB::raw("(select max(id) as id from caixa)"));
        $reserva = Reserva::find($idReserva);
        
        return View::make('lancamento-caixa', compact('totalCaixa', 'reserva'));
    }
    
    public function postReserva() {
        $idReserva = Input::get('id');
        $idUserGarcom = Input::get('idUserGarcom');
        $idFormaPagamentos = Input::get('idFormaPagamentos');
        
        $gorjeta = str_replace(array("R$", "."), "", Input::get('gorjeta'));
        $gorjeta = str_replace(",", ".", $gorjeta);
        
        $valorTotal = str_replace(array("R$", "."), "", Input::get('valorTotal'));
        $valorTotal = str_replace(",", ".", $valorTotal);
        
        DB::table('operacao_caixa')->insert(
                array('idReserva' => $idReserva, 
                    'idUserGarcom' => $idUserGarcom,
                    'idFormaPagamentos' => $idFormaPagamentos, 
                    'gorjeta' => $gorjeta,
                    'total' => $valorTotal,
                    'idUserCaixa' => Caixa::find(DB::raw("(select max(id) as id from caixa)"))->idUser,
                    'status' => 'CD'
                )
        );
        
        $reserva = Reserva::find($idReserva);
        $reserva->status = 'PA';
        $reserva->save();
        
        $caixa = Caixa::find(DB::raw("(select max(id) as id from caixa)"));
        $caixa->vlAbertura = floatval($caixa->vlAbertura + $valorTotal);
        $caixa->save();
        
        return Redirect::to('caixa');
    }
    
    public function getFechar() {
        $caixa = Caixa::find(DB::raw("(select max(id) as id from caixa)"));
        $caixa->vlFechamento = floatval($caixa->vlAbertura);
        $caixa->status = 'FC';
        $caixa->dtFechamento = date("Y-m-d H:i:s");
        $caixa->save();
        return Redirect::to('caixa');
    }
    
    public function getAbrir() {
        $caixaFechado = Caixa::find(DB::raw("(select max(id) as id from caixa)"));
        
        $caixa = new Caixa();
        $caixa->vlAbertura = floatval($caixaFechado->vlFechamento);
        $caixa->status = 'AB';
        $caixa->dtAbertura = date("Y-m-d H:i:s");
        $caixa->idUser = '5'; //COLOCAR O USUARIO LOGADO
        $caixa->save();
        return Redirect::to('caixa');
    }

}
