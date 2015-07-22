@extends('template.principal')

@section('pagina')
Reserva
@stop

@section('menu-lateral')
@include('template.menu-lateral')
@stop

@section('conteudo')
<div class="col-xs-9">
    <div class="container" id="conteudo">
        <h1 class="title_top">Lançamento Serviços/Produtos</h1>

        <div class="row_form">
            <div class="col-xs-12">
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-9 bg_ln">
                    <h4>Reserva</h4>
                </div>                
                <div class="col-xs-12"></div>

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
            </div>

            <div class="col-xs-12">
                <div class="col-xs-9 bg_ln">
                    <h4>Serviços</h4>
                </div>  

                <div class="col-xs-6 form-group">
                    <label class="control-label">Serviços: </label>
                    {{Form::select('idServico', array('' => '::SELECIONE::') + ServicoController::getServicosActive(), '', array('class' => 'form-control', 'id' => 'idServico'))}}
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">&nbsp;</label>
                    <input type="button" onclick="addServico({{$reserva->id}})" class="btn btn-cadastro form-control" id="addServico" name="addServico" value="Adicionar" />
                </div>

                @if (count($servico) != 0)
                <div class="col-xs-9 form-group">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Serviço</th>
                                <th>Descrição Serviço</th>
                                <th>Valor</th>
                                <th width="20px">Ações</th>
                            </tr>                       
                        </thead>
                        <tbody>
                            @foreach ($servico as $s)
                            <tr>
                                <td>{{$s->id}}</td>
                                <td>{{$s->servico}}</td>
                                <td>{{$s->dsServico}}</td>
                                <td>R$ {{number_format(Util::formatValor($s->vlServico), 2, ',', '.')}}</td>
                                <td><a onclick="deletarServico({{$s->id}},{{$reserva->id}})">{{ HTML::image("img/delete.png", "Deletar", array("title" => "Deletar")) }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div class="col-xs-12">
                <div class="col-xs-9 bg_ln">
                    <h4>Produtos</h4>
                </div> 

                <div class="col-xs-6 form-group">
                    <label class="control-label">Produtos: </label>
                    {{Form::select('idProduto', array('' => '::SELECIONE::') + ProdutoController::getProdutosActive(), '', array('class' => 'form-control', 'id' => 'idProduto'))}}
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">&nbsp;</label>
                    <input type="button" onclick="addProduto({{$reserva->id}})" class="btn btn-cadastro form-control" id="addProduto" name="addProduto" value="Adicionar" />
                </div>

                @if (count($produto) != 0)
                <div class="col-xs-9 form-group">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descriçao Produto</th>
                                <th>Valor</th>
                                <th width="20px">Ações</th>
                            </tr>                       
                        </thead>
                        <tbody>
                            @foreach ($produto as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->dsProduto}}</td>
                                <td>R$ {{number_format(Util::formatValor($p->vlProduto), 2, ',', '.')}}</td>
                                <td><a onclick="deletarProduto({{$p->id}},{{$reserva->id}})">{{ HTML::image("img/delete.png", "Deletar", array("title" => "Deletar")) }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
function addProduto(idReserva) {
    var idProduto = $('#idProduto').val();
    if(idProduto === ""){
        bootbox.alert("<h4>Por favor selecione o produto!</h4>");
    }else{
        bootbox.confirm({
            title: 'Adicionar Produto',
            message: 'Deseja realmente adicionar o produto?',
            buttons: {
                confirm: {
                    label: 'Sim, adicionar!',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Não!',
                    className: 'btn-negar-modal'
                }
            },
            callback: function (response) {
                if (response) {
                    location.href = '/reserva/cadproduto?idProduto=' + idProduto +'&idReserva=' + idReserva;
                }
            }
        });
    }
}
function addServico(idReserva) {
    var idServico = $('#idServico').val();
    if(idServico === ""){
        bootbox.alert("<h4>Por favor selecione o serviço!</h4>");
    }else{
        bootbox.confirm({
            title: 'Adicionar Serviço',
            message: 'Deseja realmente adicionar o serviço?',
            buttons: {
                confirm: {
                    label: 'Sim, adicionar!',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Não!',
                    className: 'btn-negar-modal'
                }
            },
            callback: function (response) {
                if (response) {
                    location.href = '/reserva/cadservico?idServico=' + idServico +'&idReserva=' + idReserva;
                }
            }
        });
    }
}
function deletarProduto(idProduto, idReserva) {
        bootbox.confirm({
            title: 'Remover Produto',
            message: 'Deseja realmente remover o produto?',
            buttons: {
                confirm: {
                    label: 'Sim, remover!',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Não!',
                    className: 'btn-negar-modal'
                }
            },
            callback: function (response) {
                if (response) {
                    location.href = '/reserva/deletproduto?idProduto=' + idProduto +'&idReserva=' + idReserva;
                }
            }
        });
}
function deletarServico(idServico, idReserva) {
        bootbox.confirm({
            title: 'Remover Serviço',
            message: 'Deseja realmente remover o serviço?',
            buttons: {
                confirm: {
                    label: 'Sim, remover!',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Não!',
                    className: 'btn-negar-modal'
                }
            },
            callback: function (response) {
                if (response) {
                    location.href = '/reserva/deletservico?idServico=' + idServico +'&idReserva=' + idReserva;
                }
            }
        });
}
</script>
@stop