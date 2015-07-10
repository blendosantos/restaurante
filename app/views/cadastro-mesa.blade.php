@extends('template.principal')

@section('pagina')
Mesa
@stop

@section('menu-lateral')
@include('template.menu-lateral')
@stop

@section('conteudo')
<div class="col-xs-9">
    <div class="container" id="conteudo">
        <h1 class="title_top">Cadastro Mesa</h1>
        <span class="dadosObrigatorio">* Dados obrigatórios</span>

        <div class="row_form">
            <div class="col-xs-12">
                <form class="row" method="POST" name="formMesa">
                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-9 bg_ln">
                        <h4>Mesa</h4>
                    </div>                
                    <div class="col-xs-12"></div>

                    <div class="col-xs-3 form-group">
                        <label class="control-label">N° Mesa: *</label>
                        <input type="text" class="form-control numero" name="nuMesa" required value="{{isset($mesa->nuMesa) ? $mesa->nuMesa : ''}}"/>
                    </div>
                    
                    <div class="col-xs-3 form-group">
                        <label class="control-label">Qtd. Assentos: *</label>
                        <input type="text" name="qtdPessoas" class="form-control numero" required value="{{isset($mesa->qtdPessoas) ? $mesa->qtdPessoas : ''}}"/>
                    </div>
                    
                    <div class="col-xs-12"></div>

                    <div class="col-xs-9 form-group">
                        <label class="control-label">Local: *</label>
                        <input type="text" class="form-control" name="localMesa" required value="{{isset($mesa->localMesa) ? $mesa->localMesa : ''}}"/>
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