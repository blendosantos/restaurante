@extends('template.principal')

@section('pagina')
Reserva
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
            <h1 class="title_top">Lista Reserva</h1>
        </div>

        <div class="col-xs-12">
            <div class="pull-right mg-bottom">
                <a class="btn btn-cadastro btn-sm" href="/reserva/cadastro" role="button">Novo</a>
                <button type="button" onclick="janelaModal()" class="btn btn-default btn-sm">Exibir Filtros</button>
            </div>
        </div>

        <div class="col-xs-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Data Reserva</th>
                        <th>Solicitante</th>
                        <th>Telefone</th>
                        <th>Mesa</th>
                        <th>Observação</th>
                        <th width="80px;">Ações</th>
                    </tr>
                </thead>
                @if (count($reserva) != 0)
                @foreach ($reserva as $r)
                <tbody>
                    <tr>
                        <td>{{$r->dtReserva}}</td>
                        <td>{{AuthController::getNomeToId($r->idUserSolicitante)}}</td>
                        <td>{{AuthController::getTelefoneToId($r->idUserSolicitante)}}</td>
                        <td>{{MesaController::getMesaToId($r->idMesa)}}</td>
                        <td>{{$r->obsReserva}}</td>
                        <td>
                            <a href="/reserva/cadastro?id={{$r->id}}">{{ HTML::image("img/edit.png", "Editar", array("title" => "Editar")) }}</a>
                            @if ($r->status == 'AA' or $r->status == 'RC')
                            <a onclick="statusReserva({{$r->id}}, 'Aprovar')">{{ HTML::image("img/aprovar.png", "Aprovar", array("title" => "Aprovar")) }}</a>
                            @else
                            <a onclick="statusReserva({{$r->id}}, 'Cancelar')">{{ HTML::image("img/inativo.png", "Cancelar", array("title" => "Cancelar")) }}</a>
                            @endif
                            <a href="/reserva/lancamento?id={{$r->id}}">{{ HTML::image("img/list-add.png", "Adicionar Serviço/Produto", array("title" => "Adicionar Serviço/Produto")) }}</a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @else
                <tbody>
                    <tr>
                        <td colspan="6"><h4 class="dadosTabela">Não Possui Reserva Agendada!</h4></td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>

<!-- -- Janela de Filtro -- -->

<div class="modal fade" id="janela" role="dialog">
    <form name="formularioPesquisa" id="formularioPesquisa" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Consultar Reserva</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Solicitante:</label>
                            {{Form::select('idUserSolicitante', array('' => '::SELECIONE::') + AuthController::getUserActive(), isset($reserva->idUserSolicitante) ? $reserva->idUserSolicitante : Input::old('idUserSolicitante'), array('class' => 'form-control'))}}
                        </div>
                        <div class="col-xs-12"></div>
                        <div class="col-xs-3 form-group">
                            <label class="control-label">Status:</label>
                            {{Form::select('status', array('' => '::SELECIONE::') + Config::get('status.reserva'), isset($reserva->status) ? $reserva->status : Input::old('status'), array('class' => 'form-control'))}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="btPesquisar" class="btn btn-primary input-sm" name="btPesquisar" value="Pesquisar">
                    <input class="btn btn-danger input-sm" type="reset" name="btLimpar" value="Limpar">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal fade -->

<!-- SCRIPTS -->
<script type="text/javascript">
            function janelaModal() {
            $('#janela').modal('show');
            }
    var entity = 'reserva';
            function lancamentoReserva(id){
            $('#addProServ' + id).modal('show');
            }
</script>
@stop