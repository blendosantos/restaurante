@extends('template.principal')

@section('pagina')
Caixa
@stop

@section('menu-lateral')
@include('template.menu-lateral')
@stop

@section('conteudo')

<style>
    .modal-dialog {
        width: 550px;
        margin: 109px auto;
    }    
</style>

<div class="col-xs-9">
    <div class="container">
        <div class="col-xs-9 bg_lx">
            <h1 class="title_top">Caixa</h1>
        </div>

        <div class="col-xs-12">
            <div class="pull-right mg-bottom">
                @if ($totalCaixa->status == "FC")
                <a class="btn btn-default btn-sm" href="/caixa/abrir" role="button">Abrir Caixa</a>
                @else
                <a class="btn btn-cadastro btn-sm" href="/caixa/fechar" role="button">Fechar Caixa</a>
                <a class="btn btn-cadastro btn-sm" href="/caixa/lancar" role="button">Fechar Reservas</a>
                @endif
            </div>
        </div>
        <div class="col-xs-12 form-group"></div>

        @if (Request::is('caixa'))
        @if ($totalCaixa->status == "AB")
        <div class="col-xs-12 form-group">
            <div class="col-xs-3 form-group">
                <label class="control-label caixa">Total em Caixa</label>
                <label class="form-control vlCaixa">R$ {{number_format(Util::formatValor($totalCaixa->vlAbertura), 2, ',', '.')}}</label>
            </div>
            <div class="col-xs-3 form-group"></div>
            <div class="col-xs-3 form-group">
                <label class="control-label caixa">Total a entrar</label>
                <label class="form-control vlCaixa">R$ {{number_format(Util::formatValor($reservas[0]->vlServico + $reservas[0]->vlProduto), 2, ',', '.')}}</label>
            </div>
        </div>
        @endif
        @endif

        @if (Request::is('caixa/lancar'))
        <div class="col-xs-12 form-group">

            <div class="col-xs-9 bg_lx">
                <h1 class="title_top">Reservas Ativas</h1>
            </div>

            @if (count($reservas) != 0)
            @foreach ($reservas as $reserva)
            <div class="col-xs-12 form-group">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Solicitante: <span>{{AuthController::getNomeToId($reserva->idUserSolicitante)}}</span></label>                        
                        </div>

                        <div class="col-xs-3 form-group">
                            <label class="control-label">Mesa: <span>{{MesaController::getMesaToId($reserva->idMesa)}}</span></label>
                        </div>

                        <div class="col-xs-12"></div>

                        <div class="col-xs-6 form-group">
                            <label class="control-label">Observação: <span>{{$reserva->obsReserva}}</span></label>
                        </div>

                        <div class="col-xs-3 form-group">
                            <label class="control-label">Data Reserva: <span>{{$reserva->dtReserva}}</span></label>
                        </div>

                        @if (count(CaixaController::getServicos($reserva->id)) != 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Descrição Serviço</th>
                                    <th>Valor</th>
                                </tr>                       
                            </thead>
                            <tbody>
                                @foreach (CaixaController::getServicos($reserva->id) as $s)
                                <tr>
                                    <td>{{$s->servico}}</td>
                                    <td>{{$s->dsServico}}</td>
                                    <td>R$ {{number_format(Util::formatValor($s->vlServico), 2, ',', '.')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                        @if (count(CaixaController::getProdutos($reserva->id)) != 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Descriçao Produto</th>
                                    <th>Valor</th>
                                </tr>                       
                            </thead>
                            <tbody>
                                @foreach (CaixaController::getProdutos($reserva->id) as $p)
                                <tr>
                                    <td>{{$p->dsProduto}}</td>
                                    <td>R$ {{number_format(Util::formatValor($p->vlProduto), 2, ',', '.')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                        <div class="col-xs-12 form-group">
                            <label class="control-label">
                                Total: 
                                <span>
                                    R$ {{number_format(Util::formatValor(CaixaController::getValorProdutos($reserva->id)[0]->vlProduto + CaixaController::getValorServicos($reserva->id)[0]->valor), 2, ',', '.')}}
                                </span>
                            </label>
                        </div>

                        <a class="btn btn-cadastro btn-sm" href="/caixa/reserva?id={{$reserva->id}}" role="button">Fechar Reserva</a>

                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
        @endif

        @if (Request::is('caixa/reserva'))
        <form method="POST">
            <div class="col-xs-12">
                <div class="col-xs-6 form-group">
                    <label class="control-label">Solicitante: <span>{{AuthController::getNomeToId($reserva->idUserSolicitante)}}</span></label>                        
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Mesa: <span>{{MesaController::getMesaToId($reserva->idMesa)}}</span></label>
                </div>

                <div class="col-xs-12"></div>

                <div class="col-xs-6 form-group">
                    <label class="control-label">Observação: <span>{{$reserva->obsReserva}}</span></label>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Data Reserva: <span>{{$reserva->dtReserva}}</span></label>
                </div>
                <div class="col-xs-12 form-group">
                    <label class="control-label">
                        Total: 
                        <span>
                            R$ {{number_format(Util::formatValor(CaixaController::getValorProdutos($reserva->id)[0]->vlProduto + CaixaController::getValorServicos($reserva->id)[0]->valor), 2, ',', '.')}}
                        </span>
                    </label>
                </div>

                <div class="col-xs-6 form-group">
                    <label class="control-label">Garçom: *</label>
                    {{Form::select('idUserGarcom', array('' => '::SELECIONE::') + AuthController::getUserGarcom(), '', array('class' => 'form-control','required' => 'required'))}}
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Gorgeta:</label>
                    <input name="gorjeta" id="gorjeta" class="form-control valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," value=""/>
                </div>

                <div class="col-xs-6 form-group">
                    <label class="control-label">Forma de Pagamento: *</label>
                    {{Form::select('idFormaPagamentos', array('' => '::SELECIONE::') + CaixaController::getFormaPagamento(), '', array('class' => 'form-control','required' => 'required'))}}
                </div>

                <div class="col-xs-12 form-group"></div>
                <div class="col-xs-6 form-group"></div>

                <div class="col-xs-3 form-group">
                    <input class="btn btn-cadastro btn-block" type="submit"  value="Confirmar" name="cadastrar"/>
                </div>
                <input type="hidden"  value="{{CaixaController::getValorProdutos($reserva->id)[0]->vlProduto + CaixaController::getValorServicos($reserva->id)[0]->valor}}" name="valorTotal"/>
            </div>
        </form>

        <script type="text/javascript">
            var gorjeta = "{{number_format((CaixaController::getValorProdutos($reserva->id)[0]->vlProduto + CaixaController::getValorServicos($reserva->id)[0]->valor) * 2.0 / 100, 2, ',', '.')}}";
            $("#gorjeta").val(gorjeta);
        </script>
        @endif

    </div>
</div>


@stop