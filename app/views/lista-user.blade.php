@extends('template.principal')

@section('pagina')
Usuário
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
            <h1 class="title_top">Lista Serviço</h1>
        </div>

        <div class="col-xs-12">
            <div class="pull-right mg-bottom">
                <a class="btn btn-cadastro btn-sm" href="/usuario/cadastro" role="button">Novo</a>
                <button type="button" onclick="janelaModal()" class="btn btn-default btn-sm">Exibir Filtros</button>
            </div>
        </div>

        <div class="col-xs-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th width="80px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <ul class="pager">
                <li><a id="anterior" disabled>Anterior</a></li>
                <span id="numeracao"></span>
                <li><a id="proximo">Próximo</a></li>
            </ul>

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
                    <h4 class="modal-title">Consultar Usuário</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Nome: </label>
                            <input type="text" class="form-control" name="nome" />
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

    var dados = <?php echo $usuario; ?>;
    var tamanhoPagina = 10;
    var pagina = 0;
    var entity = 'usuario';
    function paginar() {
        $('table > tbody > tr').remove();
        var tbody = $('table > tbody');
        for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) * tamanhoPagina; i++) {
            tbody.append(
                    $('<tr>')
                    .append($('<td>').append(dados[i].nmPessoa))
                    .append($('<td>').append(dados[i].cpf))
                    .append($('<td>').append(dados[i].telefone))
                    .append($('<td>')
                    .append('<a href="/' + entity + '/cadastro?id=' + dados[i].id + '">{{ HTML::image("img/edit.png", "Editar", array("title" => "Editar")) }}</a> ')
                    .append('<a href="/' + entity + '/'+(dados[i].status === 'AT' ? 'inativar' : 'ativar')+'?id=' + dados[i].id + '">{{ HTML::image("img/'+(dados[i].status === 'AT' ? 'inativo' : 'ativo')+'.png") }}</a>')
                    .append('<a onclick="excluirItem(' + dados[i].id + ')">{{ HTML::image("img/delete.png", "Deletar", array("title" => "Deletar")) }}</a>'))
            )

        }
        $('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(dados.length / tamanhoPagina));
    }
</script>
@stop