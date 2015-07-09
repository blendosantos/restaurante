@extends('template.principal')

@section('pagina')
Produto
@stop

@section('menu-lateral')
    @include('template.menu-lateral')
@stop

@section('conteudo')
<div class="col-xs-9">
<div class="container" id="conteudo">
    <h1 class="title_top">Cadastro Produto</h1>
    <span class="dadosObrigatorio">* Dados obrigatórios</span>

    <div class="row_form">
        <div class="col-xs-12">
            <form class="row" method="POST" name="formCadastroProduto">

                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-9 bg_ln">
                    <h4>Produto</h4>
                </div>                
                <div class="col-xs-12"></div>

                <div class="col-xs-9 form-group">
                    <label class="control-label">Descriçao: *</label>
                    <input type="text" class="form-control" name="dsProduto" required value="{{isset($produto->dsProduto) ? $produto->dsProduto : ''}}"/>
                </div>
                
                <div class="col-xs-12"></div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Quantidade: *</label>
                    <input type="text" name="qtdProduto" class="form-control numero" required value="{{isset($produto->qtdProduto) ? $produto->qtdProduto : ''}}"/>
                </div>                

                <div class="col-xs-3 form-group">
                    <label class="control-label">Valor: *</label>
                    <input type="text" name="vlProduto" class="form-control valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required value="{{isset($produto->vlProduto) ? Util::formatValor($produto->vlProduto) : ''}}"/>
                </div>

                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-6"></div>

                <div class="col-xs-3 form-group">
                    <input class="btn btn-cadastro btn-block" type="submit" value="Cadastrar" name="cadastrar"/>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
@stop