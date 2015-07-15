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
                        <th width="50px;">Ações</th>
                    </tr>
                </thead>
                @if (count($reserva) != 0)
                @foreach ($reserva as $r)
                <tbody>
                    <tr>
                        <td>{{$r->dtReserva}}</td>
                        <td>{{AuthController::getNomeToId($r->idUserSolicitante)}}</td>
                        <td>{{AuthController::getTelefoneToId($r->idUserSolicitante)}}</td>
                        <td>{{$r->idMesa}}</td>
                        <td>{{$r->obsReserva}}</td>
                        <td>
                            <a href="/reserva/cadastro?id={{$r->id}}">{{ HTML::image("img/edit.png", "Editar", array("title" => "Editar")) }}</a>
                            @if ($r->status == 'AA')
                            <a onclick="statusReserva({{$r->id}}, 'Aprovar')">{{ HTML::image("img/aprovar.png", "Aprovar", array("title" => "Aprovar")) }}</a>
                            @else
                            <a onclick="statusReserva({{$r->id}}, 'Cancelar')">{{ HTML::image("img/inativo.png", "Cancelar", array("title" => "Cancelar")) }}</a>
                            @endif
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

<form name="formularioPesquisa" id="formularioPesquisa" method="POST">
    <div class="modal fade" id="janela" role="dialog">
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
                            <input type="text" class="form-control" name="idUserSolicitante" required/>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class="col-xs-2 form-group">
                            <label class="control-label">Data Reserva:</label>
                            <input type="text" class="form-control data" name="dataInicio" id="dataInicio" required/>
                        </div>
                        <div class="col-xs-2" style="width: 10% !important;">
                            <label class="control-label">&nbsp;</label>
                            <input type="text" class="form-control" disabled="" value="Até" style="text-align: center;background-color: #FFF;border: none;font-weight: bolder;"/>
                        </div>
                        <div class="col-xs-2 form-group">
                            <label class="control-label">&nbsp;</label>
                            <input type="text" class="form-control data" name="dataFinal" id="dataFinal" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="btPesquisar" class="btn btn-primary input-sm" name="btPesquisar" value="Pesquisar">
                    <input class="btn btn-danger input-sm" type="reset" name="btLimpar" value="Limpar">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal fade -->
</form>

<!-- SCRIPTS -->
<script>
            function janelaModal() {
                $('#janela').modal('show');
            }
            var entity = 'reserva';
</script>
@stop