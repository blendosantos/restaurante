@extends('template.principal')

@section('pagina')
Mesa
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
            <h1 class="title_top">Lista Mesa</h1>
        </div>

        <div class="col-xs-12">
            <div class="pull-right mg-bottom">
                <a class="btn btn-cadastro btn-sm" href="/mesa/cadastro" role="button">Novo</a>
            </div>
        </div>

        <div class="col-xs-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nº Mesa</th>
                        <th>Qtd. Assento</th>
                        <th>Local</th>
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


<!-- SCRIPTS -->
<script>

    function janelaModal() {
        $('#janela').modal('show');
    }

    var dados = <?php echo $mesa; ?>;
    var tamanhoPagina = 10;
    var pagina = 0;
    var entity = 'mesa';
    function paginar() {
        $('table > tbody > tr').remove();
        var tbody = $('table > tbody');
        for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) * tamanhoPagina; i++) {
            tbody.append(
                    $('<tr>')
                    .append($('<td>').append(dados[i].nuMesa))
                    .append($('<td>').append(dados[i].qtdPessoas))
                    .append($('<td>').append(dados[i].localMesa))
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