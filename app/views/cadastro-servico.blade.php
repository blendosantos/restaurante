@extends('template.principal')

@section('pagina')
Serviço
@stop

@section('menu-lateral')
@include('template.menu-lateral')
@stop

@section('conteudo')
<div class="col-xs-9">
    <div class="container" id="conteudo">
        <h1 class="title_top">Cadastro Serviço</h1>
        <span class="dadosObrigatorio">* Dados obrigatórios</span>

        <div class="row_form">
            <div class="col-xs-12">
                <form class="row" method="POST" name="formServico" accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-9 bg_ln">
                        <h4>Serviço</h4>
                    </div>                
                    <div class="col-xs-12"></div>

                    <div class="col-xs-9 form-group">
                        <label class="control-label">Serviço: *</label>
                        <input type="text" class="form-control" name="servico" required value="{{isset($servico->servico) ? $servico->servico : ''}}"/>
                    </div>

                    <div class="col-xs-9 form-group">
                        <label class="control-label">Descriçao: *</label>
                        <input type="text" class="form-control" name="dsServico" required value="{{isset($servico->dsServico) ? $servico->dsServico : ''}}"/>
                    </div>

                    <div class="col-xs-12"></div>               

                    <div class="col-xs-3 form-group">
                        <label class="control-label">Valor: *</label>
                        <input type="text" name="vlServico" class="form-control valor" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal="," required value="{{isset($servico->vlServico) ? Util::formatValor($servico->vlServico) : ''}}"/>
                    </div>

                    <div class="col-xs-3 form-group">
                        <label class="control-label">Imagem: *</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-file">
                                    Arquivo… <input type="file" name="img" accept="image/*">
                                </span>
                            </span>
                            <input type="text" class="form-control" id="img" readonly="" value="{{isset($servico->img) ? $servico->img : ''}}">
                        </div>
                    </div>

                    <div class="col-xs-3 form-group">
                        <label class="control-label">Destaque: *</label>
                        <div class="input-group">
                            <input type="radio" name="destaque" required value="S" <?php if(isset($servico->destaque) && $servico->destaque == 'S'){ echo "checked"; }; ?>/>SIM &nbsp;
                            <input type="radio" name="destaque" required value="N" <?php if(isset($servico->destaque) && $servico->destaque == 'N'){ echo "checked"; }; ?>/>NÃO
                        </div>
                    </div>

                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-6"></div>

                    <div class="col-xs-3 form-group">
                        <input class="btn btn-cadastro btn-block" type="submit" onclick="return verificaDestaque()" value="Cadastrar" name="cadastrar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop